<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\StudentAppeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class StudentAppealController extends Controller
{
    /**
     * Show appeal submission form
     */
    public function create($applicationId)
    {
        if (!Auth::user()->isUser()) {
            abort(403, 'Unauthorized access');
        }

        // Get the application and verify it belongs to the user
        $application = StudentApplication::with(['schoolProgramme.diplomaProgramme'])
            ->where('user_id', Auth::id())
            ->findOrFail($applicationId);

        // Only allow appeals for rejected applications
        if ($application->status !== 'rejected') {
            return redirect()->route('user.my-applications')
                ->with('error', 'You can only appeal rejected applications.');
        }

        // Check if appeal already exists
        $existingAppeal = StudentAppeal::where('user_id', Auth::id())
            ->where('student_application_id', $applicationId)
            ->first();

        if ($existingAppeal) {
            return redirect()->route('user.appeal-status', $existingAppeal->id)
                ->with('info', 'You have already submitted an appeal for this application.');
        }

        return view('user.submit-appeal', compact('application'));
    }

    /**
     * Store appeal submission
     */
    public function store(Request $request, $applicationId)
    {
        if (!Auth::user()->isUser()) {
            abort(403, 'Unauthorized access');
        }

        // Verify the application belongs to the user
        $application = StudentApplication::where('user_id', Auth::id())
            ->where('status', 'rejected')
            ->findOrFail($applicationId);

        // Check if appeal already exists
        $existingAppeal = StudentAppeal::where('user_id', Auth::id())
            ->where('student_application_id', $applicationId)
            ->first();

        if ($existingAppeal) {
            throw ValidationException::withMessages([
                'appeal' => 'You have already submitted an appeal for this application.'
            ]);
        }

        $request->validate([
            'appeal_reason' => 'required|string|min:50|max:2000',
            'supporting_documents.*' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png' // 5MB max
        ]);

        DB::transaction(function() use ($request, $application) {
            $supportingDocs = [];

            // Handle file uploads
            if ($request->hasFile('supporting_documents')) {
                foreach ($request->file('supporting_documents') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('appeal_documents/' . Auth::id(), $filename, 'public');
                    $supportingDocs[] = $path;
                }
            }

            // Create the appeal
            StudentAppeal::create([
                'user_id' => Auth::id(),
                'student_application_id' => $application->id,
                'appeal_reason' => $request->appeal_reason,
                'supporting_documents' => $supportingDocs,
                'status' => 'pending'
            ]);
        });

        return redirect()->route('user.my-applications')
            ->with('success', 'Your appeal has been submitted successfully. You will be notified once it has been reviewed.');
    }

    /**
     * Show appeal status
     */
    public function show($appealId)
    {
        if (!Auth::user()->isUser()) {
            abort(403, 'Unauthorized access');
        }

        $appeal = StudentAppeal::with([
            'studentApplication.schoolProgramme.diplomaProgramme',
            'reviewer'
        ])
        ->where('user_id', Auth::id())
        ->findOrFail($appealId);

        return view('user.appeal-status', compact('appeal'));
    }

    /**
     * List all appeals for the current user
     */
    public function index()
    {
        if (!Auth::user()->isUser()) {
            abort(403, 'Unauthorized access');
        }

        $appeals = StudentAppeal::with([
            'studentApplication.schoolProgramme.diplomaProgramme',
            'reviewer'
        ])
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('user.my-appeals', compact('appeals'));
    }
}