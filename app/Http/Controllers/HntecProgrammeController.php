<?php

namespace App\Http\Controllers;

use App\Models\HntecProgramme;
use Illuminate\Http\Request;

class HntecProgrammeController extends Controller
{
    /**
     * Check if user is authorized to manage HNTEC programmes
     */
    private function checkAuthorization(): void
    {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Display a listing of HNTEC programmes
     */
    public function index(Request $request)
    {
        $this->checkAuthorization();
        
        $query = HntecProgramme::query();
        
        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }
        
        // Handle sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        
        // Validate sort parameters
        $allowedSortColumns = ['id', 'name', 'created_at'];
        $allowedSortOrders = ['asc', 'desc'];
        
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'name';
        }
        
        if (!in_array($sortOrder, $allowedSortOrders)) {
            $sortOrder = 'asc';
        }
        
        $query->orderBy($sortBy, $sortOrder);
        
        $programmes = $query->get();
        
        return view('staff.admission.hntec-programmes', compact('programmes'));
    }

    /**
     * Store a newly created HNTEC programme
     */
    public function store(Request $request)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:hntec_programmes,name',
        ], [
            'name.required' => 'Programme name is required.',
            'name.unique' => 'This programme already exists.',
        ]);

        try {
            HntecProgramme::create([
                'name' => $request->name,
            ]);

            return redirect()->route('staff.admission.hntec-programmes')
                ->with('success', 'Programme added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to add programme. Please try again.');
        }
    }

    /**
     * Update the specified HNTEC programme
     */
    public function update(Request $request, HntecProgramme $hntecProgramme)
    {
        $this->checkAuthorization();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:hntec_programmes,name,' . $hntecProgramme->id,
        ], [
            'name.required' => 'Programme name is required.',
            'name.unique' => 'This programme already exists.',
        ]);

        try {
            $hntecProgramme->update([
                'name' => $request->name,
            ]);

            return redirect()->route('staff.admission.hntec-programmes')
                ->with('success', 'Programme updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update programme. Please try again.');
        }
    }

    /**
     * Remove the specified HNTEC programme
     */
    public function destroy(HntecProgramme $hntecProgramme)
    {
        $this->checkAuthorization();
        
        try {
            $programmeName = $hntecProgramme->name;
            $hntecProgramme->delete();

            return redirect()->route('staff.admission.hntec-programmes')
                ->with('success', "Programme '{$programmeName}' deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete programme. Please try again.');
        }
    }
}