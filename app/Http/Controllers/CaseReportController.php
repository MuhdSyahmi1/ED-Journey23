<?php

namespace App\Http\Controllers;

use App\Models\CaseReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseReportController extends Controller
{
    /**
     * Display a listing of case reports (for admission managers).
     */
    public function index(Request $request)
    {
        // Check if user is admission manager
        if (auth()->user()->role !== 'staff' || auth()->user()->manager_type !== 'admission') {
            abort(403, 'Unauthorized');
        }

        $query = CaseReport::with('user');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Apply subject type filter
        if ($request->filled('subject_type')) {
            $query->where('subject_type', $request->input('subject_type'));
        }

        // Apply case type filter
        if ($request->filled('case_type')) {
            $query->where('case_type', $request->input('case_type'));
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $caseReports = $query->orderBy('created_at', 'desc')->paginate(15);

        // Preserve query parameters in pagination links
        $caseReports->appends($request->query());

        return view('staff.admission.case-reports', compact('caseReports'));
    }

    /**
     * Store a newly created case report.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'subject_type' => 'required|in:Hntec,O-Level,A-Level',
            'case_type' => 'required|in:Incorrect Data,Missing Subject,Incorrect Data & Missing Subject',
            'description' => 'required|string|max:1000',
        ]);

        try {
            CaseReport::create([
                'user_id' => Auth::id(),
                'subject' => $request->subject,
                'subject_type' => $request->subject_type,
                'case_type' => $request->case_type,
                'description' => $request->description,
                'status' => 'pending',
            ]);

            return redirect()->back()->with('success', 'Case report submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error submitting case report: ' . $e->getMessage());
        }
    }

    /**
     * Update the status of a case report (for admission managers).
     */
    public function updateStatus(Request $request, CaseReport $caseReport)
    {
        // Check if user is admission manager
        if (auth()->user()->role !== 'staff' || auth()->user()->manager_type !== 'admission') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:pending,in progress,solved'
        ]);

        try {
            $caseReport->update([
                'status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Case report status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating status: ' . $e->getMessage());
        }
    }
}