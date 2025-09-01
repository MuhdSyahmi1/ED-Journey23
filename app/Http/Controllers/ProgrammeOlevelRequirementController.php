<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeOlevelRequirement;
use App\Models\SchoolProgramme;
use App\Models\OLevelSubject;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class ProgrammeOlevelRequirementController extends Controller
{
    /**
     * Get O Level requirements for a specific school programme with filtering and search.
     */
    public function index(Request $request, string $school, int $programmeId): JsonResponse
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|in:Compulsory,General',
            'qualification' => 'nullable|in:IGCSE,GCE',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1'
        ]);

        // Verify school programme exists and belongs to the school
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        $query = ProgrammeOlevelRequirement::with(['oLevelSubject'])
            ->where('school_programme_id', $programmeId);

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('oLevelSubject', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%");
            });
        }

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply qualification filter
        if ($request->filled('qualification')) {
            $query->whereHas('oLevelSubject', function ($q) use ($request) {
                $q->where('qualification', $request->qualification);
            });
        }

        // Get paginated results
        $requirements = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $requirements->items(),
            'meta' => [
                'current_page' => $requirements->currentPage(),
                'last_page' => $requirements->lastPage(),
                'per_page' => $requirements->perPage(),
                'total' => $requirements->total(),
            ],
            'school_programme' => $schoolProgramme->load('diplomaProgramme')
        ]);
    }

    /**
     * Get available O Level subjects for a specific school programme.
     */
    public function getAvailableOLevelSubjects(string $school, int $programmeId): JsonResponse
    {
        // Verify school programme exists
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        // Get O Level subjects that aren't already assigned to this school programme
        $assignedSubjectIds = ProgrammeOlevelRequirement::where('school_programme_id', $programmeId)
            ->pluck('o_level_subject_id')
            ->toArray();

        $availableSubjects = OLevelSubject::whereNotIn('id', $assignedSubjectIds)
            ->orderBy('name')
            ->get(['id', 'name', 'qualification']);

        return response()->json([
            'success' => true,
            'data' => $availableSubjects
        ]);
    }

    /**
     * Store a new O Level requirement.
     */
    public function store(Request $request, string $school, int $programmeId): JsonResponse
    {
        // Verify school programme exists
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        $request->validate([
            'o_level_subject_id' => [
                'required',
                'integer',
                'exists:o_level_subjects,id',
                Rule::unique('programme_olevel_requirements')->where(function ($query) use ($programmeId) {
                    return $query->where('school_programme_id', $programmeId);
                })
            ],
            'category' => 'required|in:Compulsory,General',
            'min_grade' => 'required|in:A*,A(a),B(b),C(c),D(d),E(e),F(f),U'
        ]);

        try {
            $requirement = ProgrammeOlevelRequirement::create([
                'school_programme_id' => $programmeId,
                'o_level_subject_id' => $request->o_level_subject_id,
                'category' => $request->category,
                'min_grade' => $request->min_grade
            ]);

            $requirement->load('oLevelSubject');

            return response()->json([
                'success' => true,
                'message' => 'O Level requirement added successfully',
                'data' => $requirement
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add O Level requirement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing O Level requirement.
     */
    public function update(Request $request, string $school, int $programmeId, ProgrammeOlevelRequirement $requirement): JsonResponse
    {
        // Verify requirement belongs to the specified school programme
        if ($requirement->school_programme_id != $programmeId || 
            $requirement->schoolProgramme->school !== $school) {
            return response()->json(['error' => 'O Level requirement not found for this programme'], 404);
        }

        $request->validate([
            'category' => 'sometimes|required|in:Compulsory,General',
            'min_grade' => 'sometimes|required|in:A*,A(a),B(b),C(c),D(d),E(e),F(f),U'
        ]);

        try {
            $requirement->update($request->only(['category', 'min_grade']));
            $requirement->load('oLevelSubject');

            return response()->json([
                'success' => true,
                'message' => 'O Level requirement updated successfully',
                'data' => $requirement
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update O Level requirement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an O Level requirement.
     */
    public function destroy(string $school, int $programmeId, ProgrammeOlevelRequirement $requirement): JsonResponse
    {
        // Verify requirement belongs to the specified school programme
        if ($requirement->school_programme_id != $programmeId || 
            $requirement->schoolProgramme->school !== $school) {
            return response()->json(['error' => 'O Level requirement not found for this programme'], 404);
        }

        try {
            $requirement->delete();

            return response()->json([
                'success' => true,
                'message' => 'O Level requirement deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete O Level requirement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete O Level requirements.
     */
    public function bulkDestroy(Request $request, string $school, int $programmeId): JsonResponse
    {
        $request->validate([
            'requirement_ids' => 'required|array|min:1',
            'requirement_ids.*' => 'integer|exists:programme_olevel_requirements,id'
        ]);

        try {
            $deletedCount = ProgrammeOlevelRequirement::whereIn('id', $request->requirement_ids)
                ->where('school_programme_id', $programmeId)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => "{$deletedCount} O Level requirements deleted successfully",
                'deleted_count' => $deletedCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete O Level requirements',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get statistics for O Level requirements.
     */
    public function getStatistics(string $school, int $programmeId): JsonResponse
    {
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        $stats = [
            'total_requirements' => ProgrammeOlevelRequirement::where('school_programme_id', $programmeId)->count(),
            'compulsory_subjects' => ProgrammeOlevelRequirement::where('school_programme_id', $programmeId)
                ->where('category', 'Compulsory')->count(),
            'general_subjects' => ProgrammeOlevelRequirement::where('school_programme_id', $programmeId)
                ->where('category', 'General')->count(),
            'average_min_grade' => $this->getAverageGrade($programmeId)
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Calculate average minimum grade (returns grade letter).
     */
    private function getAverageGrade(int $programmeId): string
    {
        $requirements = ProgrammeOlevelRequirement::where('school_programme_id', $programmeId)
            ->get(['min_grade']);

        if ($requirements->isEmpty()) {
            return 'N/A';
        }

        $gradeValues = $requirements->map(function ($requirement) {
            return match($requirement->min_grade) {
                'A*' => 8,
                'A(a)' => 7,
                'B(b)' => 6,
                'C(c)' => 5,
                'D(d)' => 4,
                'E(e)' => 3,
                'F(f)' => 2,
                'U' => 1,
                default => 0
            };
        });

        $averageValue = $gradeValues->avg();

        // Convert back to grade letter
        return match(round($averageValue)) {
            8 => 'A*',
            7 => 'A(a)',
            6 => 'B(b)',
            5 => 'C(c)',
            4 => 'D(d)',
            3 => 'E(e)',
            2 => 'F(f)',
            1 => 'U',
            default => 'C(c)'
        };
    }
}