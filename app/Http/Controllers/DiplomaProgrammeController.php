<?php

namespace App\Http\Controllers;

use App\Models\DiplomaProgramme;
use Illuminate\Http\Request;

class DiplomaProgrammeController extends Controller
{
    /**
     * Check if user is authorized to manage Diploma programmes
     */
    private function checkAuthorization(): void
    {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Display a listing of Diploma programmes
     */
    public function index(Request $request)
    {
        $this->checkAuthorization();
        
        $query = DiplomaProgramme::query();
        
        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('school', 'LIKE', "%{$search}%")
                  ->orWhere('duration', 'LIKE', "%{$search}%");
            });
        }

        // Handle school filter
        if ($request->has('school') && $request->school != '') {
            $query->where('school', $request->school);
        }
        
        // Handle sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        
        // Validate sort parameters
        $allowedSortColumns = ['id', 'name', 'duration', 'school', 'created_at'];
        $allowedSortOrders = ['asc', 'desc'];
        
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'name';
        }
        
        if (!in_array($sortOrder, $allowedSortOrders)) {
            $sortOrder = 'asc';
        }
        
        $query->orderBy($sortBy, $sortOrder);
        
        $programmes = $query->get();
        
        return view('staff.admission.diploma-programmes', compact('programmes'));
    }

    /**
     * Store a newly created Diploma programme
     */
    public function store(Request $request)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:diploma_programmes,name',
            'duration' => 'required|in:' . implode(',', DiplomaProgramme::getDurationOptions()),
            'school' => 'required|in:' . implode(',', DiplomaProgramme::getSchoolOptions()),
        ], [
            'name.required' => 'Programme name is required.',
            'name.unique' => 'This programme already exists.',
            'duration.required' => 'Duration is required.',
            'duration.in' => 'Please select a valid duration.',
            'school.required' => 'School is required.',
            'school.in' => 'Please select a valid school.',
        ]);

        try {
            DiplomaProgramme::create([
                'name' => $request->name,
                'duration' => $request->duration,
                'school' => $request->school,
            ]);

            return redirect()->route('staff.admission.diploma-programmes')
                ->with('success', 'Programme added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to add programme. Please try again.');
        }
    }

    /**
     * Update the specified Diploma programme
     */
    public function update(Request $request, DiplomaProgramme $diplomaProgramme)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:diploma_programmes,name,' . $diplomaProgramme->id,
            'duration' => 'required|in:' . implode(',', DiplomaProgramme::getDurationOptions()),
            'school' => 'required|in:' . implode(',', DiplomaProgramme::getSchoolOptions()),
        ], [
            'name.required' => 'Programme name is required.',
            'name.unique' => 'This programme already exists.',
            'duration.required' => 'Duration is required.',
            'duration.in' => 'Please select a valid duration.',
            'school.required' => 'School is required.',
            'school.in' => 'Please select a valid school.',
        ]);

        try {
            $diplomaProgramme->update([
                'name' => $request->name,
                'duration' => $request->duration,
                'school' => $request->school,
            ]);

            return redirect()->route('staff.admission.diploma-programmes')
                ->with('success', 'Programme updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update programme. Please try again.');
        }
    }

    /**
     * Remove the specified Diploma programme
     */
    public function destroy(DiplomaProgramme $diplomaProgramme)
    {
        $this->checkAuthorization();
        
        try {
            $programmeName = $diplomaProgramme->name;
            $diplomaProgramme->delete();

            return redirect()->route('staff.admission.diploma-programmes')
                ->with('success', "Programme '{$programmeName}' deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete programme. Please try again.');
        }
    }
}