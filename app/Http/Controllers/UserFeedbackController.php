<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class UserFeedbackController extends Controller
{
    /**
     * Display the feedback form and user's feedback history
     */
    public function index()
    {
        // Get current user's feedback with pagination
        $feedback = Feedback::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.feedback', compact('feedback'));
    }

    /**
     * Store a new feedback
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|min:5|max:255',
            'message' => 'required|string|min:10|max:1000',
            'priority' => 'required|in:low,medium,high'
        ], [
            'subject.required' => 'Subject is required.',
            'subject.min' => 'Subject must be at least 5 characters.',
            'subject.max' => 'Subject cannot exceed 255 characters.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters.',
            'message.max' => 'Message cannot exceed 1000 characters.',
            'priority.required' => 'Priority level is required.',
            'priority.in' => 'Invalid priority level selected.'
        ]);

        try {
            Feedback::create([
                'user_id' => Auth::id(),
                'subject' => $request->subject,
                'message' => $request->message,
                'priority' => $request->priority,
                'status' => 'pending' // Default status
            ]);

            return redirect()->route('user.feedback')
                ->with('success', 'Your feedback has been submitted successfully! We will review it and get back to you soon.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while submitting your feedback. Please try again.');
        }
    }

    /**
     * Show a specific feedback (optional - for detailed view)
     */
    public function show($id)
    {
        $feedback = Feedback::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.feedback-detail', compact('feedback'));
    }
}