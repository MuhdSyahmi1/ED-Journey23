<?php

namespace App\Http\Controllers;

use App\Models\SchoolProgramme;
use App\Models\DiplomaProgramme;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class SchoolProgrammeController extends Controller
{
    /**
     * Get programmes for a specific school with filtering and search.
     */
    public function index(Request $request, string $school): JsonResponse
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'duration' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1'
        ]);

        $query = SchoolProgramme::with(['diplomaProgramme'])
            ->forSchool($school)
            ->active();

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('diplomaProgramme', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%");
            });
        }

        // Apply duration filter
        if ($request->filled('duration')) {
            $query->where('duration', $request->duration);
        }

        // Get paginated results
        $programmes = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $programmes->items(),
            'meta' => [
                'current_page' => $programmes->currentPage(),
                'last_page' => $programmes->lastPage(),
                'per_page' => $programmes->perPage(),
                'total' => $programmes->total(),
            ]
        ]);
    }

    /**
     * Get available diploma programmes for a specific school.
     */
    public function getAvailableProgrammes(string $school): JsonResponse
    {
        // Map school slug to school name
        $schoolNameMap = [
            'business' => 'School of Business',
            'health' => 'School of Health Sciences',
            'ict' => 'School of ICT',
            'engineering' => 'School of Science & Engineering',
            'petrochemical' => 'School of Petrochemical'
        ];

        $schoolName = $schoolNameMap[$school] ?? null;
        if (!$schoolName) {
            return response()->json(['error' => 'Invalid school'], 400);
        }

        // Get diploma programmes for this school that aren't already assigned
        $assignedProgrammeIds = SchoolProgramme::forSchool($school)
            ->pluck('diploma_programme_id')
            ->toArray();

        $availableProgrammes = DiplomaProgramme::where('school', $schoolName)
            ->whereNotIn('id', $assignedProgrammeIds)
            ->orderBy('name')
            ->get(['id', 'name', 'duration']);

        return response()->json([
            'success' => true,
            'data' => $availableProgrammes
        ]);
    }

    /**
     * Store a new school programme.
     */
    public function store(Request $request, string $school): JsonResponse
    {
        $request->validate([
            'diploma_programme_id' => [
                'required',
                'integer',
                'exists:diploma_programmes,id',
                Rule::unique('school_programmes')->where(function ($query) use ($school) {
                    return $query->where('school', $school);
                })
            ],
            'duration' => 'required|in:1.0,1.5,2.0,2.5,3.0,3.5,4.0,4.5,5.0'
        ]);

        try {
            $schoolProgramme = SchoolProgramme::create([
                'diploma_programme_id' => $request->diploma_programme_id,
                'school' => $school,
                'duration' => $request->duration,
                'is_active' => true
            ]);

            $schoolProgramme->load('diplomaProgramme');

            return response()->json([
                'success' => true,
                'message' => 'Programme added successfully',
                'data' => $schoolProgramme
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add programme',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing school programme.
     */
    public function update(Request $request, string $school, SchoolProgramme $programme): JsonResponse
    {
        // Ensure the programme belongs to the specified school
        if ($programme->school !== $school) {
            return response()->json(['error' => 'Programme not found for this school'], 404);
        }

        $request->validate([
            'duration' => 'sometimes|required|in:1.0,1.5,2.0,2.5,3.0,3.5,4.0,4.5,5.0',
            'is_active' => 'sometimes|boolean'
        ]);

        try {
            $programme->update($request->only(['duration', 'is_active']));
            $programme->load('diplomaProgramme');

            return response()->json([
                'success' => true,
                'message' => 'Programme updated successfully',
                'data' => $programme
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update programme',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a school programme.
     */
    public function destroy(string $school, SchoolProgramme $programme): JsonResponse
    {
        // Ensure the programme belongs to the specified school
        if ($programme->school !== $school) {
            return response()->json(['error' => 'Programme not found for this school'], 404);
        }

        try {
            $programme->delete();

            return response()->json([
                'success' => true,
                'message' => 'Programme deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete programme',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete school programmes.
     */
    public function bulkDestroy(Request $request, string $school): JsonResponse
    {
        $request->validate([
            'programme_ids' => 'required|array|min:1',
            'programme_ids.*' => 'integer|exists:school_programmes,id'
        ]);

        try {
            $deletedCount = SchoolProgramme::whereIn('id', $request->programme_ids)
                ->where('school', $school)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => "{$deletedCount} programmes deleted successfully",
                'deleted_count' => $deletedCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete programmes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get statistics for a specific school.
     */
    public function getStatistics(string $school): JsonResponse
    {
        $stats = [
            'total_programmes' => SchoolProgramme::forSchool($school)->count(),
            'active_programmes' => SchoolProgramme::forSchool($school)->active()->count(),
            'total_students' => $this->getStudentCount($school),
            'faculty_members' => $this->getFacultyCount($school)
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get estimated student count for a school (placeholder - implement based on your student model).
     */
    private function getStudentCount(string $school): int
    {
        // This would typically query your students table
        // For now, return mock data based on school
        return match($school) {
            'business' => 850,
            'health' => 620,
            'ict' => 740,
            'engineering' => 920,
            'petrochemical' => 380,
            default => 0
        };
    }

    /**
     * Get estimated faculty count for a school (placeholder - implement based on your faculty model).
     */
    private function getFacultyCount(string $school): int
    {
        // This would typically query your faculty/staff table
        // For now, return mock data based on school
        return match($school) {
            'business' => 25,
            'health' => 18,
            'ict' => 22,
            'engineering' => 30,
            'petrochemical' => 15,
            default => 0
        };
    }
}