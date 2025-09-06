<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentGrade;
use App\Models\HntecResult;
use App\Models\SchoolProgramme;
use App\Models\ProgrammeOlevelRequirement;
use App\Models\ProgrammeHntecRequirement;
use App\Models\OLevelSubject;
use App\Models\HntecProgramme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserRecommendationController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        
        // Get student's qualifications
        $studentGrades = StudentGrade::where('user_id', $user->id)->with('ocrResult')->get();
        
        // Get HNTec results from separate table
        $hntecResults = HntecResult::where('user_id', $user->id)
            ->whereHas('ocrResult', function($query) {
                $query->where('ocr_type', 'hntec');
            })
            ->get();
        

        
        // Separate qualifications by type - primarily use OCR type since qualification field is often null
        $oLevelGrades = $studentGrades->filter(function($grade) {
            return ($grade->ocrResult && $grade->ocrResult->ocr_type === 'o_level') ||
                   $grade->qualification === 'O-Level';
        })->keyBy('subject');
        
        $aLevelGrades = $studentGrades->filter(function($grade) {
            return ($grade->ocrResult && $grade->ocrResult->ocr_type === 'a_level') ||
                   $grade->qualification === 'A-Level';
        })->keyBy('subject');
        
        // Use the separate HNTec results table instead of student grades
        $hntecGrades = $hntecResults;
        
        // Get all active programmes with their requirements
        $programmes = SchoolProgramme::with([
            'diplomaProgramme',
            'oLevelRequirements.oLevelSubject',
            'hntecRequirements.hntecProgramme'
        ])
        ->where('is_active', 1)
        ->get();
        
        // Analyze programmes using Smart Requirements Analysis
        $recommendations = $this->analyzeRequirements($programmes, $oLevelGrades, $aLevelGrades, $hntecGrades);
        
        // Get user's existing applications
        $existingApplications = \App\Models\StudentApplication::where('user_id', $user->id)
            ->with(['schoolProgramme.diplomaProgramme'])
            ->orderBy('preference_rank')
            ->get();
        
        return view('user.recommendations', compact('recommendations', 'oLevelGrades', 'aLevelGrades', 'hntecGrades', 'existingApplications'));
    }
    
    private function analyzeRequirements($programmes, $oLevelGrades, $aLevelGrades, $hntecGrades): array
    {
        $qualified = [];
        $nonTailoredQualified = [];
        $nonQualified = [];
        
        foreach ($programmes as $programme) {
            $analysis = $this->analyzeProgrammeRequirements($programme, $oLevelGrades, $aLevelGrades, $hntecGrades);
            
            if ($analysis['status'] === 'qualified') {
                $qualified[] = [
                    'programme' => $programme,
                    'analysis' => $analysis,
                    'match_score' => $analysis['match_score']
                ];
            } elseif ($analysis['status'] === 'non_tailored_qualified') {
                $nonTailoredQualified[] = [
                    'programme' => $programme,
                    'analysis' => $analysis,
                    'match_score' => $analysis['match_score']
                ];
            } else {
                $nonQualified[] = [
                    'programme' => $programme,
                    'analysis' => $analysis,
                    'match_score' => $analysis['match_score']
                ];
            }
        }
        
        // Sort by match score (highest first)
        usort($qualified, fn($a, $b) => $b['match_score'] <=> $a['match_score']);
        usort($nonTailoredQualified, fn($a, $b) => $b['match_score'] <=> $a['match_score']);
        usort($nonQualified, fn($a, $b) => $b['match_score'] <=> $a['match_score']);
        
        return [
            'qualified' => $qualified,
            'non_tailored_qualified' => $nonTailoredQualified,
            'non_qualified' => $nonQualified
        ];
    }
    
    private function analyzeProgrammeRequirements($programme, $oLevelGrades, $aLevelGrades, $hntecGrades): array
    {
        $compulsoryOLevels = $programme->oLevelRequirements->where('category', 'Compulsory');
        $optionalOLevels = $programme->oLevelRequirements->where('category', 'General');
        $compulsoryHntecs = $programme->hntecRequirements->where('category', 'Relevant');
        $optionalHntecs = $programme->hntecRequirements->where('category', 'Not Relevant');
        
        
        $analysis = [
            // O-Level Path Analysis
            'olevel_path' => [
                'compulsory_met' => true,
                'compulsory_details' => [],
                'optional_met' => 0,
                'optional_total' => $optionalOLevels->count(),
                'missing_requirements' => [],
                'exceeded_requirements' => [],
                'match_score' => 0,
                'qualified' => false
            ],
            // HNTec Path Analysis  
            'hntec_path' => [
                'compulsory_met' => true,
                'compulsory_details' => [],
                'optional_met' => 0,
                'optional_total' => $optionalHntecs->count(),
                'missing_requirements' => [],
                'exceeded_requirements' => [],
                'match_score' => 0,
                'qualified' => false
            ],
            // Overall Analysis (for backward compatibility)
            'compulsory_olevel_met' => true,
            'compulsory_hntec_met' => true,
            'missing_requirements' => [],
            'exceeded_requirements' => [],
            'match_score' => 0
        ];
        
        // Check compulsory O-Level requirements (for O-Level path)
        foreach ($compulsoryOLevels as $requirement) {
            $subjectName = $requirement->oLevelSubject->name;
            $requiredGrade = $requirement->min_grade;
            
            if (!$oLevelGrades->has($subjectName)) {
                $analysis['olevel_path']['compulsory_met'] = false;
                $analysis['olevel_path']['missing_requirements'][] = "Missing required O-Level subject: {$subjectName}";
                $analysis['olevel_path']['compulsory_details'][$subjectName] = [
                    'required' => $requiredGrade,
                    'achieved' => null,
                    'met' => false
                ];
                // Legacy compatibility
                $analysis['compulsory_olevel_met'] = false;
                $analysis['missing_requirements'][] = "Missing required O-Level subject: {$subjectName}";
            } else {
                $studentGrade = $oLevelGrades[$subjectName]->grade;
                $gradeMet = $this->compareGrades($studentGrade, $requiredGrade);
                
                if (!$gradeMet) {
                    $analysis['olevel_path']['compulsory_met'] = false;
                    $analysis['olevel_path']['missing_requirements'][] = "O-Level {$subjectName}: required {$requiredGrade}, achieved {$studentGrade}";
                    // Legacy compatibility
                    $analysis['compulsory_olevel_met'] = false;
                    $analysis['missing_requirements'][] = "O-Level {$subjectName}: required {$requiredGrade}, achieved {$studentGrade}";
                } else {
                    $analysis['olevel_path']['exceeded_requirements'][] = "O-Level {$subjectName}: {$studentGrade} (required {$requiredGrade})";
                    $analysis['exceeded_requirements'][] = "O-Level {$subjectName}: {$studentGrade} (required {$requiredGrade})";
                }
                
                $analysis['olevel_path']['compulsory_details'][$subjectName] = [
                    'required' => $requiredGrade,
                    'achieved' => $studentGrade,
                    'met' => $gradeMet
                ];
            }
        }
        
        // Check optional O-Level requirements
        foreach ($optionalOLevels as $requirement) {
            $subjectName = $requirement->oLevelSubject->name;
            $requiredGrade = $requirement->min_grade;
            
            if ($oLevelGrades->has($subjectName)) {
                $studentGrade = $oLevelGrades[$subjectName]->grade;
                if ($this->compareGrades($studentGrade, $requiredGrade)) {
                    $analysis['olevel_path']['optional_met']++;
                    $analysis['olevel_path']['exceeded_requirements'][] = "Optional O-Level {$subjectName}: {$studentGrade}";
                    // Legacy compatibility
                    $analysis['exceeded_requirements'][] = "Optional O-Level {$subjectName}: {$studentGrade}";
                }
            }
        }
        
        // Check compulsory HNTec requirements (for HNTec path)
        // HNTec logic: If student has ANY qualifying HNTec programme that meets CGPA, they qualify
        $hasAnyQualifyingHntec = false;
        $qualifyingHntecDetails = [];
        $missingHntecDetails = [];
        
        foreach ($compulsoryHntecs as $requirement) {
            $hntecName = $requirement->hntecProgramme->name;
            $requiredCgpa = $requirement->min_cgpa;
            
            $hasQualification = false;
            $studentCgpa = null;
            
            // Check against HntecResult model (programme field and cgpa field)
            foreach ($hntecGrades as $hntecResult) {
                $studentProgramme = strtolower(trim($hntecResult->programme));
                $requiredProgramme = strtolower(trim($hntecName));
                
                // Try exact match first, then partial matches
                if ($studentProgramme === $requiredProgramme ||
                    str_contains($studentProgramme, $requiredProgramme) || 
                    str_contains($requiredProgramme, $studentProgramme) ||
                    // Handle "Information Technology" variations
                    (str_contains($studentProgramme, 'information technology') && str_contains($requiredProgramme, 'information technology'))) {
                    $hasQualification = true;
                    $studentCgpa = $hntecResult->cgpa;
                    break;
                }
            }
            
            // Track details for each requirement
            $analysis['hntec_path']['compulsory_details'][$hntecName] = [
                'required' => $requiredCgpa,
                'achieved' => $studentCgpa,
                'met' => $hasQualification && $studentCgpa >= $requiredCgpa
            ];
            
            if ($hasQualification && $studentCgpa >= $requiredCgpa) {
                // This HNTec qualifies the student
                $hasAnyQualifyingHntec = true;
                $qualifyingHntecDetails[] = "HNTec {$hntecName}: CGPA {$studentCgpa} (required {$requiredCgpa})";
            } elseif (!$hasQualification) {
                $missingHntecDetails[] = "Missing required HNTec: {$hntecName}";
            } elseif ($studentCgpa < $requiredCgpa) {
                $missingHntecDetails[] = "HNTec {$hntecName}: required CGPA {$requiredCgpa}, achieved {$studentCgpa}";
            }
        }
        
        // Set HNTec path status based on whether ANY HNTec requirement is met
        if ($hasAnyQualifyingHntec) {
            $analysis['hntec_path']['compulsory_met'] = true;
            $analysis['hntec_path']['exceeded_requirements'] = array_merge(
                $analysis['hntec_path']['exceeded_requirements'], 
                $qualifyingHntecDetails
            );
            $analysis['exceeded_requirements'] = array_merge(
                $analysis['exceeded_requirements'], 
                $qualifyingHntecDetails
            );
            // Legacy compatibility
            $analysis['compulsory_hntec_met'] = true;
        } else {
            $analysis['hntec_path']['compulsory_met'] = false;
            $analysis['hntec_path']['missing_requirements'] = array_merge(
                $analysis['hntec_path']['missing_requirements'], 
                $missingHntecDetails
            );
            $analysis['missing_requirements'] = array_merge(
                $analysis['missing_requirements'], 
                $missingHntecDetails
            );
            // Legacy compatibility
            $analysis['compulsory_hntec_met'] = false;
        }
        
        // Check optional HNTec requirements
        foreach ($optionalHntecs as $requirement) {
            $hntecName = $requirement->hntecProgramme->name;
            $requiredCgpa = $requirement->min_cgpa;
            
            foreach ($hntecGrades as $hntecResult) {
                $studentProgramme = strtolower(trim($hntecResult->programme));
                $requiredProgramme = strtolower(trim($hntecName));
                
                if ($studentProgramme === $requiredProgramme ||
                    str_contains($studentProgramme, $requiredProgramme) || 
                    str_contains($requiredProgramme, $studentProgramme) ||
                    (str_contains($studentProgramme, 'information technology') && str_contains($requiredProgramme, 'information technology'))) {
                    
                    if ($hntecResult->cgpa >= $requiredCgpa) {
                        $analysis['hntec_path']['optional_met']++;
                        $analysis['hntec_path']['exceeded_requirements'][] = "Optional HNTec {$hntecName}: CGPA {$hntecResult->cgpa}";
                    }
                    break;
                }
            }
        }
        
        // Calculate match scores for each path
        // O-Level Path Score
        $oLevelTotalReqs = $compulsoryOLevels->count() + $optionalOLevels->count();
        $oLevelMetReqs = 0;
        if ($analysis['olevel_path']['compulsory_met']) {
            $oLevelMetReqs += $compulsoryOLevels->count();
        }
        $oLevelMetReqs += $analysis['olevel_path']['optional_met'];
        $analysis['olevel_path']['match_score'] = $oLevelTotalReqs > 0 ? ($oLevelMetReqs / $oLevelTotalReqs) * 100 : 0;
        $analysis['olevel_path']['qualified'] = $analysis['olevel_path']['compulsory_met'];
        
        // HNTec Path Score
        $hntecTotalReqs = $compulsoryHntecs->count() + $optionalHntecs->count();
        $hntecMetReqs = 0;
        if ($analysis['hntec_path']['compulsory_met']) {
            $hntecMetReqs += $compulsoryHntecs->count();
        }
        $hntecMetReqs += $analysis['hntec_path']['optional_met'];
        $analysis['hntec_path']['match_score'] = $hntecTotalReqs > 0 ? ($hntecMetReqs / $hntecTotalReqs) * 100 : 0;
        $analysis['hntec_path']['qualified'] = $analysis['hntec_path']['compulsory_met'];
        
        // Legacy overall match score (use the higher of the two paths)
        $analysis['match_score'] = max($analysis['olevel_path']['match_score'], $analysis['hntec_path']['match_score']);
        
        // HNTec Bonus: If student has strong HNTec qualifications, boost their scores
        $hasStrongHntec = false;
        foreach ($hntecGrades as $hntecResult) {
            if ($hntecResult->cgpa >= 3.5) { // Strong CGPA threshold
                $hasStrongHntec = true;
                // Boost match scores for strong HNTec
                $analysis['hntec_path']['match_score'] = min(100, $analysis['hntec_path']['match_score'] + 15);
                $analysis['match_score'] = min(100, $analysis['match_score'] + 15);
                break;
            }
        }
        
        
        // Determine status based on either path qualification
        // If student meets compulsory requirements for either path, they qualify
        if ($analysis['olevel_path']['qualified'] || $analysis['hntec_path']['qualified']) {
            // Qualified if either path meets compulsory requirements
            if ($analysis['hntec_path']['qualified'] && $analysis['hntec_path']['match_score'] >= 80) {
                $analysis['status'] = 'qualified';
            } else if ($analysis['olevel_path']['qualified'] && $analysis['olevel_path']['match_score'] >= 80) {
                $analysis['status'] = 'qualified';
            } else {
                // Even if match score is low, they're still qualified if compulsory requirements are met
                $analysis['status'] = 'non_tailored_qualified';
            }
        } else {
            // Only not qualified if they fail to meet compulsory requirements for BOTH paths
            $analysis['status'] = 'non_qualified';
        }
        
        return $analysis;
    }
    
    private function compareGrades(string $achievedGrade, string $requiredGrade): bool
    {
        // Map both formats to a common numeric scale
        $gradeMap = [
            // Standard format from database migration
            'A*' => 1, 'A(a)' => 2, 'B(b)' => 3, 'C(c)' => 4, 'D(d)' => 5, 'E(e)' => 6, 'F(f)' => 7, 'U' => 8,
            // Student data format (single letters)
            'A' => 2, 'B' => 3, 'C' => 4, 'D' => 5, 'E' => 6, 'F' => 7
        ];
        
        $achievedValue = $gradeMap[$achievedGrade] ?? 999; // Default to worst grade if not found
        $requiredValue = $gradeMap[$requiredGrade] ?? 999;
        
        // Lower number = better grade, so achieved should be <= required
        return $achievedValue <= $requiredValue;
    }
}
