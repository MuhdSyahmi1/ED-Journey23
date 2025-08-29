<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class StaffController extends Controller
{
    /**
     * Check if user is staff
     */
    private function checkStaffRole(): void
    {
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Show feedback management for staff
     */
    public function feedback()
    {
        $this->checkStaffRole();
        
        // Get all feedback with user information
        $allFeedback = Feedback::with(['user', 'repliedByUser'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Group feedback by status for easy filtering
        $pendingFeedback = $allFeedback->where('status', 'pending');
        $inProgressFeedback = $allFeedback->where('status', 'in-progress');
        $solvedFeedback = $allFeedback->where('status', 'solved');
        
        // Get feedback statistics
        $stats = [
            'total' => $allFeedback->count(),
            'pending' => $pendingFeedback->count(),
            'in_progress' => $inProgressFeedback->count(),
            'solved' => $solvedFeedback->count(),
            'high_priority' => $allFeedback->where('priority', 'high')->count(),
        ];
        
        return view('staff.feedback', compact(
            'allFeedback', 
            'pendingFeedback', 
            'inProgressFeedback', 
            'solvedFeedback', 
            'stats'
        ));
    }

    /**
     * Reply to feedback and update status
     */
    public function replyFeedback(Request $request, $id)
    {
        $this->checkStaffRole();
        
        $request->validate([
            'admin_reply' => 'required|string|min:10',
            'status' => 'required|in:pending,in-progress,solved'
        ]);
        
        $feedback = Feedback::findOrFail($id);
        
        $feedback->update([
            'admin_reply' => $request->admin_reply,
            'status' => $request->status,
            'replied_by' => auth()->id(),
            'replied_at' => now(),
            'resolved_at' => $request->status === 'solved' ? now() : null,
        ]);
        
        $statusText = match($request->status) {
            'pending' => 'marked as pending',
            'in-progress' => 'marked as in progress',
            'solved' => 'marked as solved',
        };
        
        return redirect()->route('staff.feedback')
            ->with('success', "Feedback replied to and {$statusText}!");
    }

    /**
     * Update feedback status only (quick action)
     */
    public function updateFeedbackStatus(Request $request, $id)
    {
        $this->checkStaffRole();
        
        $request->validate([
            'status' => 'required|in:pending,in-progress,solved'
        ]);
        
        $feedback = Feedback::findOrFail($id);
        
        $feedback->update([
            'status' => $request->status,
            'resolved_at' => $request->status === 'solved' ? now() : null,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }
}
