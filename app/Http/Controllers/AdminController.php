<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Check if user is admin
     */
    private function checkAdminRole()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Show admin dashboard with real statistics
     */
    public function dashboard()
    {
        $this->checkAdminRole();
        
        // Get dashboard statistics
        $totalManagers = User::where('role', 'staff')->count();
        $activeManagers = User::where('role', 'staff')->where('status', 'active')->count();
        $inactiveManagers = User::where('role', 'staff')->where('status', 'inactive')->count();
        
        // Manager role distribution
        $programManagers = User::where('role', 'staff')->where('manager_type', 'program')->count();
        $admissionManagers = User::where('role', 'staff')->where('manager_type', 'admission')->count();
        $newsEventsManagers = User::where('role', 'staff')->where('manager_type', 'news_events')->count();
        $moderators = User::where('role', 'staff')->where('manager_type', 'moderators')->count();
        $dataAnalyticsManagers = User::where('role', 'staff')->where('manager_type', 'data_analytics')->count();
        
        // Feedback statistics (pending case reports)
        $pendingFeedback = Feedback::where('status', 'pending')->count();
        $inProgressFeedback = Feedback::where('status', 'in-progress')->count();
        $solvedFeedback = Feedback::where('status', 'solved')->count();
        
        // Recent feedback for case reports
        $recentFeedback = Feedback::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalManagers', 
            'activeManagers', 
            'inactiveManagers',
            'programManagers',
            'admissionManagers', 
            'newsEventsManagers',
            'moderators',
            'dataAnalyticsManagers',
            'pendingFeedback',
            'inProgressFeedback',
            'solvedFeedback',
            'recentFeedback'
        ));
    }

    /**
     * Show manage account page
     */
    public function manageAccount()
    {
        $this->checkAdminRole();
        
        $managers = User::where('role', 'staff')
            ->with('createdBy')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.ManageAccount', compact('managers'));
    }

    /**
     * Create new manager/staff with role assignment
     */
    public function createManager(Request $request)
    {
        $this->checkAdminRole();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'manager_type' => 'required|in:program,admission,news_events,moderators,data_analytics',
            'status' => 'required|in:active,inactive'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'manager_type' => $request->manager_type,
            'status' => $request->status ?? 'active',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.manage-account')
            ->with('success', 'Manager created successfully!');
    }

    /**
     * Update manager details and role
     */
    public function updateManager(Request $request, $id)
    {
        $this->checkAdminRole();
        
        $manager = User::where('role', 'staff')->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $manager->id,
            'manager_type' => 'required|in:program,admission,news_events,moderators,data_analytics',
            'status' => 'required|in:active,inactive'
        ]);

        $manager->update([
            'name' => $request->name,
            'email' => $request->email,
            'manager_type' => $request->manager_type,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.manage-account')
            ->with('success', 'Manager updated successfully!');
    }

    /**
     * Delete manager
     */
    public function deleteManager($id)
    {
        $this->checkAdminRole();
        
        $manager = User::where('role', 'staff')->findOrFail($id);
        $managerName = $manager->name;
        $manager->delete();

        return redirect()->route('admin.manage-account')
            ->with('success', "Manager '{$managerName}' deleted successfully!");
    }

    /**
     * Toggle manager status (active/inactive)
     */
    public function toggleManagerStatus($id)
    {
        $this->checkAdminRole();
        
        $manager = User::where('role', 'staff')->findOrFail($id);
        $newStatus = $manager->status === 'active' ? 'inactive' : 'active';
        
        $manager->update(['status' => $newStatus]);
        
        $statusText = $newStatus === 'active' ? 'activated' : 'deactivated';
        
        return redirect()->route('admin.manage-account')
            ->with('success', "Manager '{$manager->name}' has been {$statusText}!");
    }

    /**
     * Show feedback management
     */
    public function feedback()
    {
        $this->checkAdminRole();
        
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
        
        return view('admin.feedback', compact(
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
        $this->checkAdminRole();
        
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
        
        return redirect()->route('admin.feedback')
            ->with('success', "Feedback replied to and {$statusText}!");
    }

    /**
     * Update feedback status only (quick action)
     */
    public function updateFeedbackStatus(Request $request, $id)
    {
        $this->checkAdminRole();
        
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

    /**
     * Get dashboard data for AJAX requests (for charts)
     */
    public function getDashboardData()
    {
        $this->checkAdminRole();
        
        return response()->json([
            'managers' => [
                'active' => User::where('role', 'staff')->where('status', 'active')->count(),
                'inactive' => User::where('role', 'staff')->where('status', 'inactive')->count(),
            ],
            'manager_roles' => [
                'program' => User::where('role', 'staff')->where('manager_type', 'program')->count(),
                'admission' => User::where('role', 'staff')->where('manager_type', 'admission')->count(),
                'news_events' => User::where('role', 'staff')->where('manager_type', 'news_events')->count(),
                'moderators' => User::where('role', 'staff')->where('manager_type', 'moderators')->count(),
                'data_analytics' => User::where('role', 'staff')->where('manager_type', 'data_analytics')->count(),
            ],
            'feedback' => [
                'pending' => Feedback::where('status', 'pending')->count(),
                'in_progress' => Feedback::where('status', 'in-progress')->count(),
                'solved' => Feedback::where('status', 'solved')->count(),
            ]
        ]);
    }
}