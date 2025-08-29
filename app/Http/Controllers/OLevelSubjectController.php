<?php

namespace App\Http\Controllers;

use App\Models\OLevelSubject;
use Illuminate\Http\Request;

class OLevelSubjectController extends Controller
{
    /**
     * Check if user is authorized to manage O Level subjects
     */
    private function checkAuthorization(): void
    {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Display a listing of O Level subjects
     */
    public function index(Request $request)
    {
        $this->checkAuthorization();
        
        $query = OLevelSubject::query();
        
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
        
        return view('staff.admission.olevel-subjects', compact('subjects'));
    }

    /**
     * Store a newly created O Level subject
     */
    public function store(Request $request)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:o_level_subjects,name',
            'qualification' => 'required|in:GCE,IGCSE',
        ], [
            'name.required' => 'Subject name is required.',
            'name.unique' => 'This subject already exists.',
            'qualification.required' => 'Qualification is required.',
            'qualification.in' => 'Please select a valid qualification (GCE or IGCSE).',
        ]);

        try {
            OLevelSubject::create([
                'name' => $request->name,
                'qualification' => $request->qualification,
            ]);

            return redirect()->route('staff.admission.olevel-subjects')
                ->with('success', 'Subject added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to add subject. Please try again.');
        }
    }

    /**
     * Update the specified O Level subject
     */
    public function update(Request $request, OLevelSubject $oLevelSubject)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:o_level_subjects,name,' . $oLevelSubject->id,
            'qualification' => 'required|in:GCE,IGCSE',
        ], [
            'name.required' => 'Subject name is required.',
            'name.unique' => 'This subject already exists.',
            'qualification.required' => 'Qualification is required.',
            'qualification.in' => 'Please select a valid qualification (GCE or IGCSE).',
        ]);

        try {
            $oLevelSubject->update([
                'name' => $request->name,
                'qualification' => $request->qualification,
            ]);

            return redirect()->route('staff.admission.olevel-subjects')
                ->with('success', 'Subject updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update subject. Please try again.');
        }
    }

    /**
     * Remove the specified O Level subject
     */
    public function destroy(OLevelSubject $oLevelSubject)
    {
        $this->checkAuthorization();
        
        try {
            $subjectName = $oLevelSubject->name;
            $oLevelSubject->delete();

            return redirect()->route('staff.admission.olevel-subjects')
                ->with('success', "Subject '{$subjectName}' deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete subject. Please try again.');
        }
    }
}