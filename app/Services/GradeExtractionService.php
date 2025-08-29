<?php

namespace App\Services;

use App\Models\StudentGrade;
use App\Models\HntecResult;
use App\Models\OcrResult;

class GradeExtractionService
{
    private array $oLevelGrades = ['A', 'B', 'C', 'D', 'E'];
    private array $aLevelGrades = ['A*', 'A', 'B', 'C', 'D', 'E'];
    private array $asLevelGrades = ['a', 'b', 'c', 'd', 'e'];
    
    private array $commonSubjects = [
        'mathematics', 'math', 'english', 'english language', 'literature', 'literature in english',
        'science', 'physics', 'chemistry', 'biology', 'combined science',
        'history', 'geography', 'social studies', 'religious studies',
        'art', 'music', 'physical education', 'design and technology',
        'computer science', 'information technology', 'commerce', 'principles of accounts',
        'economics', 'business studies', 'food and nutrition', 'home economics',
        'malay', 'bahasa melayu', 'chinese', 'tamil', 'hindi', 'arabic', 'french', 'german',
        // A-Level specific subjects
        'further mathematics', 'psychology', 'sociology', 'law', 'philosophy',
        'media studies', 'film studies', 'drama', 'theatre studies'
    ];

    private array $oLevelSyllabusCodes = [
        '1123', '2281', '4037', // English Language variants
        '4024', '4025', // Mathematics variants
        '5070', '5090', // Science variants
        '2158', '2159', '5014', // History variants
        '2217', '2230', // Geography variants
        '6065', '6090', // Art variants
        '1127', '1128', '1201', // Malay Language variants
        '1116', '1117', // Chinese Language variants
        '3247', '3248', // Literature variants
    ];

    private array $aLevelSyllabusCodes = [
        '9700', '9701', // Biology
        '9702', '9703', // Chemistry
        '9709', '9231', // Mathematics
        '8021', '8682', // English Language
        '9704', // Computer Science
        '9708', // Economics
        '9696', // Geography
        '9489', // History
        '9618', // Information Technology
        '9273', // Music
        '9705', // Physics
        '9698', // Psychology
    ];

    // Common HNTec programme patterns
    private array $hntecProgrammes = [
        // Specific HNTec programmes
        'construction engineering',
        'geomatics',
        'interior design',
        'building services engineering',
        'instrumentation and control engineering',
        'mechanical engineering',
        'plant engineering',
        'automobile technology',
        'electrical engineering',
        'business and finance',
        'office administration',
        'hospitality operations',
        'travel and tourism',
        'computer networking',
        'information technology',
        'information and library studies',
        'telecommunication systems',
        'aircraft maintenance engineering (avionics)',
        'aircraft maintenance engineering (airframe & engine)',
        'electronic engineering',
        'electronics and media technology',
        'construction & draughting (dual tvet)',
        'real estate management & agency',
        'agrotechnology',
        'aquaculture technology',
        'food science and technology',
        'applied sciences',
        // General patterns (kept for broader matching)
        'engineering', 'business', 'computing', 'hospitality', 'tourism',
        'construction', 'mechanical', 'electrical', 'civil', 'automotive',
        'accounting', 'marketing', 'management',
        'software development', 'network', 'multimedia', 'graphics'
    ];

    public function extractGrades(OcrResult $ocrResult): array
    {
        $text = $ocrResult->text;
        
        if ($ocrResult->ocr_type === 'hntec') {
            // Handle HNTec separately
            return $this->extractAndSaveHntecResults($text, $ocrResult);
        }

        // Delete previous grades for this user and OCR type (O-Level and A-Level)
        StudentGrade::where('user_id', $ocrResult->user_id)
                   ->whereHas('ocrResult', function($query) use ($ocrResult) {
                       $query->where('ocr_type', $ocrResult->ocr_type);
                   })->delete();

        $extractedGrades = match($ocrResult->ocr_type) {
            'o_level' => $this->extractOLevelGrades($text, $ocrResult),
            'a_level' => $this->extractALevelGrades($text, $ocrResult),
            default => []
        };

        // Save new grades to database (O-Level and A-Level)
        foreach ($extractedGrades as $gradeData) {
            StudentGrade::create([
                'user_id' => $ocrResult->user_id,
                'ocr_result_id' => $ocrResult->id,
                'subject' => $gradeData['subject'],
                'syllabus' => $gradeData['syllabus'] ?? null,
                'grade' => $gradeData['grade'],
                'qualification' => $gradeData['qualification'] ?? null,
                'series' => $gradeData['series'] ?? null,
                'percentage' => $gradeData['percentage'] ?? null,
                'cgpa' => $gradeData['cgpa'] ?? null,
                'context_line' => $gradeData['context_line'],
                'confidence' => $gradeData['confidence']
            ]);
        }

        return $extractedGrades;
    }

    private function extractAndSaveHntecResults(string $text, OcrResult $ocrResult): array
    {
        // Delete previous HNTec results for this user
        HntecResult::where('user_id', $ocrResult->user_id)
                   ->whereHas('ocrResult', function($query) use ($ocrResult) {
                       $query->where('ocr_type', 'hntec');
                   })->delete();

        $extractedResults = $this->extractHntecGrades($text, $ocrResult);

        // Save new HNTec results to the dedicated table
        foreach ($extractedResults as $resultData) {
            HntecResult::create([
                'user_id' => $ocrResult->user_id,
                'ocr_result_id' => $ocrResult->id,
                'programme' => $resultData['subject'], // programme is stored as subject in the array
                'cgpa' => $resultData['cgpa'],
                'context_line' => $resultData['context_line'],
                'confidence' => $resultData['confidence']
            ]);
        }

        return $extractedResults;
    }

    private function extractOLevelGrades(string $text, OcrResult $ocrResult): array
    {
        $lines = explode("\n", $text);
        $extractedGrades = [];

        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);
            if (empty($line) || strlen($line) < 3) continue;

            $gradeData = $this->parseOLevelLine($line, $lineNumber);
            if ($gradeData) {
                $extractedGrades[] = $gradeData;
            }
        }

        return $extractedGrades;
    }

    private function extractALevelGrades(string $text, OcrResult $ocrResult): array
    {
        $lines = explode("\n", $text);
        $extractedGrades = [];
        $series = $this->extractSeries($text);

        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);
            if (empty($line) || strlen($line) < 5) continue;

            // Try A-Level pattern first
            $gradeData = $this->parseALevelLine($line, $lineNumber, $series);
            if ($gradeData) {
                $extractedGrades[] = $gradeData;
                continue;
            }

            // Try AS-Level pattern
            $gradeData = $this->parseASLevelLine($line, $lineNumber, $series);
            if ($gradeData) {
                $extractedGrades[] = $gradeData;
            }
        }

        return $extractedGrades;
    }

    private function extractHntecGrades(string $text, OcrResult $ocrResult): array
    {
        $extractedGrades = [];
        $lines = explode("\n", $text);
        
        $programme = null;
        $cgpa = null;

        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            // Look for programme line - specifically handle HNTec formats
            if (!$programme && preg_match('/programme[\s:+]*(.+)/i', $line, $matches)) {
                $rawProgramme = trim($matches[1]);
                // Clean up common OCR artifacts
                $rawProgramme = preg_replace('/^[+:\s]+/', '', $rawProgramme);
                
                // Fix "HNTecin" to "HNTec in" (missing space)
                if (preg_match('/HNTec\s*in\s*(.+)/i', $rawProgramme, $hntecMatches)) {
                    $programme = 'HNTec in ' . ucwords(strtolower(trim($hntecMatches[1])));
                } else {
                    $programme = $rawProgramme;
                }
                continue;
            }
            
            // Alternative pattern for direct HNTec detection
            if (!$programme && preg_match('/HNTec\s*in\s*(.+)/i', $line, $matches)) {
                $programme = 'HNTec in ' . ucwords(strtolower(trim($matches[1])));
                continue;
            }
            
            // Look for CGPA in various formats
            if (preg_match('/Cumulative\s+Grade\s+Point\s+Average[\s:]*(\d+\.?\d*)/i', $line, $matches)) {
                $cgpa = floatval($matches[1]);
                continue;
            }
            
            // Alternative CGPA pattern
            if (preg_match('/(?:CGPA|GPA)[\s:]*(\d+\.?\d*)/i', $line, $matches)) {
                $cgpa = floatval($matches[1]);
                continue;
            }
            
            // Simple pattern for lines ending with decimal numbers (like "3.7")
            if ($cgpa === null && preg_match('/:\s*(\d+\.\d+)\s*$/', $line, $matches)) {
                $potentialCgpa = floatval($matches[1]);
                // Only accept if it's in valid CGPA range (0.0 to 4.0)
                if ($potentialCgpa >= 0.0 && $potentialCgpa <= 4.0) {
                    $cgpa = $potentialCgpa;
                    continue;
                }
            }
        }

        // If we found both programme and CGPA, create the grade entry
        if ($programme && $cgpa !== null) {
            // Format CGPA to remove trailing zeros
            $formattedCgpa = rtrim(rtrim(number_format($cgpa, 2, '.', ''), '0'), '.');
            
            $extractedGrades[] = [
                'subject' => $programme,
                'grade' => null,
                'cgpa' => $formattedCgpa,
                'qualification' => 'HNTec',
                'context_line' => "Programme: {$programme}, CGPA: {$formattedCgpa}",
                'confidence' => $this->calculateHntecConfidence($programme, $cgpa),
                'line_number' => 0
            ];
        }

        return $extractedGrades;
    }

    private function parseOLevelLine(string $line, int $lineNumber): ?array
    {
        // Look for O-Level grades (A, B, C, D, E)
        if (preg_match('/\b([A-E])\b/', $line, $matches)) {
            $grade = $matches[1];
            
            if ($this->isFalsePositive($line, $grade)) {
                return null;
            }
            
            $subject = $this->extractSubject($line);
            $syllabus = $this->extractSyllabus($line, 'o_level');
            $percentage = $this->extractPercentage($line);
            $confidence = $this->calculateOLevelConfidence($line, $grade, $subject, $syllabus);

            return [
                'grade' => $grade,
                'subject' => $subject,
                'syllabus' => $syllabus,
                'percentage' => $percentage,
                'qualification' => $this->determineOLevelQualification($line),
                'series' => $this->extractSeries($line),
                'context_line' => $line,
                'confidence' => $confidence,
                'line_number' => $lineNumber
            ];
        }

        return null;
    }

    private function parseALevelLine(string $line, int $lineNumber, ?string $series): ?array
    {
        // Pattern for A-Level: syllabus_code | subject | Advanced Level | grade
        if (preg_match('/(\d{4})\s*\|\s*([A-Za-z\s]+)\s*\|\s*Advanced Level\s*\|\s*([A-E]\*?)/i', $line, $matches)) {
            $syllabusCode = trim($matches[1]);
            $subject = trim($matches[2]);
            $grade = trim($matches[3]);

            // Clean and normalize grade
            $grade = $this->normalizeALevelGrade($grade);
            
            if (!in_array($grade, $this->aLevelGrades)) {
                return null;
            }

            return [
                'grade' => $grade,
                'subject' => ucwords(strtolower($subject)),
                'syllabus' => $syllabusCode,
                'qualification' => 'Advanced Level',
                'series' => $series,
                'context_line' => $line,
                'confidence' => $this->calculateALevelConfidence($line, $grade, $subject, $syllabusCode),
                'line_number' => $lineNumber
            ];
        }

        return null;
    }

    private function parseASLevelLine(string $line, int $lineNumber, ?string $series): ?array
    {
        // Pattern for AS-Level: syllabus_code | subject | Advanced Subsidiary | grade
        if (preg_match('/(\d{4})\s*\|\s*([A-Za-z\s]+)\s*\|\s*Advanced Subsidiary\s*\|\s*([a-e])/i', $line, $matches)) {
            $syllabusCode = trim($matches[1]);
            $subject = trim($matches[2]);
            $grade = strtolower(trim($matches[3]));

            if (!in_array($grade, $this->asLevelGrades)) {
                return null;
            }

            return [
                'grade' => $grade,
                'subject' => ucwords(strtolower($subject)),
                'syllabus' => $syllabusCode,
                'qualification' => 'Advanced Subsidiary',
                'series' => $series,
                'context_line' => $line,
                'confidence' => $this->calculateASLevelConfidence($line, $grade, $subject, $syllabusCode),
                'line_number' => $lineNumber
            ];
        }

        return null;
    }

    private function extractHntecProgramme(array $lines, int $currentLine): ?string
    {
        // Look for programme name in current line first
        $line = strtolower($lines[$currentLine] ?? '');
        
        // Try to find "Programme" keyword and extract what follows
        if (preg_match('/programme[\s:]+([^:]+?)(?:cgpa|cumulative)/i', $line, $matches)) {
            return ucwords(trim($matches[1]));
        }

        // Look in previous lines (up to 3 lines back)
        for ($i = max(0, $currentLine - 3); $i < $currentLine; $i++) {
            $prevLine = strtolower($lines[$i] ?? '');
            
            if (preg_match('/programme[\s:]+(.+)/i', $prevLine, $matches)) {
                return ucwords(trim($matches[1]));
            }
            
            // Check for known programme patterns
            foreach ($this->hntecProgrammes as $programme) {
                if (strpos($prevLine, $programme) !== false) {
                    return ucwords($programme);
                }
            }
        }

        return 'Unknown Programme';
    }

    private function extractSeries(string $text): ?string
    {
        // Look for month/year pattern
        if (preg_match('/\b(January|February|March|April|May|June|July|August|September|October|November|December)\s+(\d{4})\b/', $text, $matches)) {
            return $matches[1] . ' ' . $matches[2];
        }
        return null;
    }

    private function extractPercentage(string $line): ?int
    {
        if (preg_match('/(\d{1,3})%/', $line, $matches)) {
            return intval($matches[1]);
        }
        return null;
    }

    private function normalizeALevelGrade(string $grade): string
    {
        // Handle A* variations
        if (preg_match('/A\*/', $grade)) {
            return 'A*';
        }
        return strtoupper($grade);
    }

    private function determineOLevelQualification(string $line): string
    {
        $line = strtolower($line);
        if (strpos($line, 'igcse') !== false) {
            return 'IGCSE';
        } elseif (strpos($line, 'gce') !== false) {
            return 'GCE';
        }
        return 'O Level'; // Default
    }

    private function extractSyllabus(string $line, string $type): ?string
    {
        if (preg_match('/\b(\d{4})\b/', $line, $matches)) {
            $code = $matches[1];
            $validCodes = $type === 'o_level' ? $this->oLevelSyllabusCodes : $this->aLevelSyllabusCodes;
            
            if (in_array($code, $validCodes)) {
                return $code;
            }
        }
        return null;
    }

    private function calculateOLevelConfidence(string $line, string $grade, ?string $subject, ?string $syllabus): float
    {
        $confidence = 0.3;
        if ($subject) $confidence += 0.3;
        if ($syllabus) $confidence += 0.2;
        if (preg_match('/[a-zA-Z]+[\s\-:]+[A-E]/', $line)) $confidence += 0.15;
        
        $lineLength = strlen(trim($line));
        if ($lineLength >= 10 && $lineLength <= 80) $confidence += 0.05;
        
        return min(1.0, $confidence);
    }

    private function calculateALevelConfidence(string $line, string $grade, string $subject, string $syllabus): float
    {
        $confidence = 0.4; // Higher base for structured A-Level format
        
        if (in_array($syllabus, $this->aLevelSyllabusCodes)) $confidence += 0.3;
        if (strlen($subject) > 3) $confidence += 0.2;
        if (strpos($line, '|') !== false) $confidence += 0.1; // Structured format
        
        return min(1.0, $confidence);
    }

    private function calculateASLevelConfidence(string $line, string $grade, string $subject, string $syllabus): float
    {
        return $this->calculateALevelConfidence($line, $grade, $subject, $syllabus);
    }

    private function calculateHntecConfidence(string $programme, float $cgpa): float
    {
        $confidence = 0.4; // Base confidence
        
        // Higher confidence if CGPA is in valid range
        if ($cgpa >= 0 && $cgpa <= 4.0) {
            $confidence += 0.3;
        }
        
        // Higher confidence if programme contains "HNTec"
        if (stripos($programme, 'hntec') !== false) {
            $confidence += 0.2;
        }
        
        // Higher confidence if programme matches known HNTec programmes
        $programmeNormalized = strtolower($programme);
        foreach ($this->hntecProgrammes as $knownProgramme) {
            if (stripos($programmeNormalized, strtolower($knownProgramme)) !== false) {
                $confidence += 0.1;
                break;
            }
        }
        
        return min(1.0, $confidence);
    }

    private function isFalsePositive(string $line, string $grade): bool
    {
        $line = strtolower($line);
        
        $falsePositives = [
            'class', 'section', 'block', 'building', 'room', 'level',
            'page', 'part', 'chapter', 'question', 'answer', 'option',
            'grade ' . strtolower($grade),
        ];
        
        foreach ($falsePositives as $fp) {
            if (strpos($line, $fp) !== false) {
                return true;
            }
        }
        
        return false;
    }

    private function extractSubject(string $line): ?string
    {
        $line = strtolower($line);
        
        foreach ($this->commonSubjects as $subject) {
            if (strpos($line, strtolower($subject)) !== false) {
                return ucwords($subject);
            }
        }

        if (preg_match('/^([a-zA-Z\s&]+)[\s\-:]+[A-Ea-e*]/i', $line, $matches)) {
            $potentialSubject = trim($matches[1]);
            if (strlen($potentialSubject) > 2 && strlen($potentialSubject) < 40) {
                return ucwords(strtolower($potentialSubject));
            }
        }

        return null;
    }

    public function getGradeStatistics($userId, $ocrType): array
    {
        if ($ocrType === 'hntec') {
            $hntecResults = HntecResult::where('user_id', $userId)
                                      ->whereHas('ocrResult', function($query) {
                                          $query->where('ocr_type', 'hntec');
                                      })->get();
            return $this->getHntecStatistics($hntecResults);
        }

        $grades = StudentGrade::where('user_id', $userId)
                            ->whereHas('ocrResult', function($query) use ($ocrType) {
                                $query->where('ocr_type', $ocrType);
                            })->get();
        
        return match($ocrType) {
            'o_level' => $this->getOLevelStatistics($grades),
            'a_level' => $this->getALevelStatistics($grades),
            default => []
        };
    }

    private function getOLevelStatistics($grades): array
    {
        $stats = [
            'total_grades' => $grades->count(),
            'grade_distribution' => [],
            'subjects_found' => $grades->whereNotNull('subject')->pluck('subject')->unique()->count(),
            'average_confidence' => $grades->avg('confidence') ?? 0,
            'last_scan' => $grades->max('created_at')
        ];

        foreach ($this->oLevelGrades as $grade) {
            $count = $grades->where('grade', $grade)->count();
            $stats['grade_distribution'][$grade] = [
                'count' => $count,
                'percentage' => $stats['total_grades'] > 0 ? round(($count / $stats['total_grades']) * 100, 1) : 0
            ];
        }

        return $stats;
    }

    private function getALevelStatistics($grades): array
    {
        $aLevelGrades = $grades->where('qualification', 'Advanced Level');
        $asLevelGrades = $grades->where('qualification', 'Advanced Subsidiary');

        return [
            'total_grades' => $grades->count(),
            'a_level_count' => $aLevelGrades->count(),
            'as_level_count' => $asLevelGrades->count(),
            'subjects_found' => $grades->whereNotNull('subject')->pluck('subject')->unique()->count(),
            'average_confidence' => $grades->avg('confidence') ?? 0,
            'last_scan' => $grades->max('created_at'),
            'grade_distribution' => $this->calculateALevelGradeDistribution($grades)
        ];
    }

    private function getHntecStatistics($hntecResults): array
    {
        return [
            'total_programmes' => $hntecResults->count(),
            'average_cgpa' => $hntecResults->avg('cgpa') ?? 0,
            'highest_cgpa' => $hntecResults->max('cgpa') ?? 0,
            'programmes' => $hntecResults->pluck('programme')->unique()->values()->toArray(),
            'average_confidence' => $hntecResults->avg('confidence') ?? 0,
            'last_scan' => $hntecResults->max('created_at')
        ];
    }

    private function calculateALevelGradeDistribution($grades): array
    {
        $distribution = [];
        $allGrades = array_merge($this->aLevelGrades, $this->asLevelGrades);
        
        foreach ($allGrades as $grade) {
            $count = $grades->where('grade', $grade)->count();
            $distribution[$grade] = [
                'count' => $count,
                'percentage' => $grades->count() > 0 ? round(($count / $grades->count()) * 100, 1) : 0
            ];
        }
        
        return $distribution;
    }
}