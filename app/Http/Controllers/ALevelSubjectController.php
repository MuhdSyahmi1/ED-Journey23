<?php

namespace App\Http\Controllers;

use App\Models\ALevelSubject;
use Illuminate\Http\Request;

class ALevelSubjectController extends Controller
{
    /**
     * Check if user is authorized to manage A Level subjects
     */
    private function checkAuthorization(): void
    {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Display a listing of A Level subjects
     */
    public function index(Request $request)
    {
        $this->checkAuthorization();
        
        $query = ALevelSubject::query();
        
        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('qualification', 'LIKE', "%{$search}%");
            });
        }
        
        // Handle sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        
        // Validate sort parameters
        $allowedSortColumns = ['id', 'name', 'qualification', 'created_at'];
        $allowedSortOrders = ['asc', 'desc'];
        
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'name';
        }
        
        if (!in_array($sortOrder, $allowedSortOrders)) {
            $sortOrder = 'asc';
        }
        
        $query->orderBy($sortBy, $sortOrder);
        
        $subjects = $query->get();
        
        return view('staff.admission.alevel-subjects', compact('subjects'));
    }

    /**
     * Store a newly created A Level subject
     */
    public function store(Request $request)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:a_level_subjects,name',
            'qualification' => 'required|in:Advanced Subsidiary,Advanced Level',
        ], [
            'name.required' => 'Subject name is required.',
            'name.unique' => 'This subject already exists.',
            'qualification.required' => 'Qualification is required.',
            'qualification.in' => 'Please select a valid qualification (Advanced Subsidiary or Advanced Level).',
        ]);

        try {
            ALevelSubject::create([
                'name' => $request->name,
                'qualification' => $request->qualification,
            ]);

            return redirect()->route('staff.admission.alevel-subjects')
                ->with('success', 'Subject added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to add subject. Please try again.');
        }
    }

    /**
     * Update the specified A Level subject
     */
    public function update(Request $request, ALevelSubject $aLevelSubject)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:a_level_subjects,name,' . $aLevelSubject->id,
            'qualification' => 'required|in:Advanced Subsidiary,Advanced Level',
        ], [
            'name.required' => 'Subject name is required.',
            'name.unique' => 'This subject already exists.',
            'qualification.required' => 'Qualification is required.',
            'qualification.in' => 'Please select a valid qualification (Advanced Subsidiary or Advanced Level).',
        ]);

        try {
            $aLevelSubject->update([
                'name' => $request->name,
                'qualification' => $request->qualification,
            ]);

            return redirect()->route('staff.admission.alevel-subjects')
                ->with('success', 'Subject updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update subject. Please try again.');
        }
    }

    /**
     * Remove the specified A Level subject
     */
    public function destroy(ALevelSubject $aLevelSubject)
    {
        $this->checkAuthorization();
        
        try {
            $subjectName = $aLevelSubject->name;
            $aLevelSubject->delete();

            return redirect()->route('staff.admission.alevel-subjects')
                ->with('success', "Subject '{$subjectName}' deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete subject. Please try again.');
        }
    }
}
