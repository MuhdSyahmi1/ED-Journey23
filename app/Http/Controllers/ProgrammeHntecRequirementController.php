<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeHntecRequirement;
use App\Models\SchoolProgramme;
use App\Models\HntecProgramme;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class ProgrammeHntecRequirementController extends Controller
{
    /**
     * Get HNTec requirements for a specific school programme with filtering and search.
     */
    public function index(Request $request, string $school, int $programmeId): JsonResponse
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|in:Relevant,Not Relevant',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1'
        ]);

        // Verify school programme exists and belongs to the school
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        $query = ProgrammeHntecRequirement::with(['hntecProgramme'])
            ->where('school_programme_id', $programmeId);

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('hntecProgramme', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%");
            });
        }

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
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
     * Get available HNTec programmes for a specific school programme.
     */
    public function getAvailableHntecProgrammes(string $school, int $programmeId): JsonResponse
    {
        // Verify school programme exists
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        // Get HNTec programmes that aren't already assigned to this school programme
        $assignedHntecIds = ProgrammeHntecRequirement::where('school_programme_id', $programmeId)
            ->pluck('hntec_programme_id')
            ->toArray();

        $availableProgrammes = HntecProgramme::whereNotIn('id', $assignedHntecIds)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'success' => true,
            'data' => $availableProgrammes
        ]);
    }

    /**
     * Store a new HNTec requirement.
     */
    public function store(Request $request, string $school, int $programmeId): JsonResponse
    {
        // Verify school programme exists
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        $request->validate([
            'hntec_programme_id' => [
                'required',
                'integer',
                'exists:hntec_programmes,id',
                Rule::unique('programme_hntec_requirements')->where(function ($query) use ($programmeId) {
                    return $query->where('school_programme_id', $programmeId);
                })
            ],
            'category' => 'required|in:Relevant,Not Relevant',
            'min_cgpa' => 'required|numeric|between:1.0,4.0|regex:/^\d{1}\.\d{1,2}$/'
        ]);

        try {
            $requirement = ProgrammeHntecRequirement::create([
                'school_programme_id' => $programmeId,
                'hntec_programme_id' => $request->hntec_programme_id,
                'category' => $request->category,
                'min_cgpa' => $request->min_cgpa
            ]);

            $requirement->load('hntecProgramme');

            return response()->json([
                'success' => true,
                'message' => 'HNTec requirement added successfully',
                'data' => $requirement
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add HNTec requirement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing HNTec requirement.
     */
    public function update(Request $request, string $school, int $programmeId, ProgrammeHntecRequirement $requirement): JsonResponse
    {
        // Verify requirement belongs to the specified school programme
        if ($requirement->school_programme_id != $programmeId || 
            $requirement->schoolProgramme->school !== $school) {
            return response()->json(['error' => 'HNTec requirement not found for this programme'], 404);
        }

        $request->validate([
            'category' => 'sometimes|required|in:Relevant,Not Relevant',
            'min_cgpa' => 'sometimes|required|numeric|between:1.0,4.0|regex:/^\d{1}\.\d{1,2}$/'
        ]);

        try {
            $requirement->update($request->only(['category', 'min_cgpa']));
            $requirement->load('hntecProgramme');

            return response()->json([
                'success' => true,
                'message' => 'HNTec requirement updated successfully',
                'data' => $requirement
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update HNTec requirement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an HNTec requirement.
     */
    public function destroy(string $school, int $programmeId, ProgrammeHntecRequirement $requirement): JsonResponse
    {
        // Verify requirement belongs to the specified school programme
        if ($requirement->school_programme_id != $programmeId || 
            $requirement->schoolProgramme->school !== $school) {
            return response()->json(['error' => 'HNTec requirement not found for this programme'], 404);
        }

        try {
            $requirement->delete();

            return response()->json([
                'success' => true,
                'message' => 'HNTec requirement deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete HNTec requirement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete HNTec requirements.
     */
    public function bulkDestroy(Request $request, string $school, int $programmeId): JsonResponse
    {
        $request->validate([
            'requirement_ids' => 'required|array|min:1',
            'requirement_ids.*' => 'integer|exists:programme_hntec_requirements,id'
        ]);

        try {
            $deletedCount = ProgrammeHntecRequirement::whereIn('id', $request->requirement_ids)
                ->where('school_programme_id', $programmeId)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => "{$deletedCount} HNTec requirements deleted successfully",
                'deleted_count' => $deletedCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete HNTec requirements',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get statistics for HNTec requirements.
     */
    public function getStatistics(string $school, int $programmeId): JsonResponse
    {
        $schoolProgramme = SchoolProgramme::where('id', $programmeId)
            ->where('school', $school)
            ->firstOrFail();

        $stats = [
            'total_requirements' => ProgrammeHntecRequirement::where('school_programme_id', $programmeId)->count(),
            'relevant_programmes' => ProgrammeHntecRequirement::where('school_programme_id', $programmeId)
                ->where('category', 'Relevant')->count(),
            'not_relevant_programmes' => ProgrammeHntecRequirement::where('school_programme_id', $programmeId)
                ->where('category', 'Not Relevant')->count(),
            'average_min_cgpa' => ProgrammeHntecRequirement::where('school_programme_id', $programmeId)
                ->avg('min_cgpa') ?: 0
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}