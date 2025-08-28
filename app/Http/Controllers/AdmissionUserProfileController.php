<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdmissionUserProfileController extends Controller
{
    /**
     * Display a listing of user profiles for admission managers.
     */
    public function index(Request $request)
    {
        // Check if user is admission manager
        if (auth()->user()->role !== 'staff' || auth()->user()->manager_type !== 'admission') {
            abort(403, 'Unauthorized');
        }

        $query = DB::table('user_profiles')
            ->join('users', 'user_profiles.user_id', '=', 'users.id')
            ->select(
                'user_profiles.*',
                'users.name as full_name',
                'users.email'
            );

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%")
                  ->orWhere('user_profiles.identity_card', 'like', "%{$search}%")
                  ->orWhere('user_profiles.user_id', 'like', "%{$search}%");
            });
        }

        // Apply verification status filter
        if ($request->filled('status')) {
            $query->where('user_profiles.verification_status', $request->input('status'));
        }

        $userProfiles = $query->orderBy('user_profiles.created_at', 'desc')->paginate(15);

        // Preserve query parameters in pagination links
        $userProfiles->appends($request->query());

        return view('staff.admission.user-profile', compact('userProfiles'));
    }

    /**
     * Show detailed profile for verification.
     */
    public function show($id)
    {
        // Check if user is admission manager
        if (auth()->user()->role !== 'staff' || auth()->user()->manager_type !== 'admission') {
            abort(403, 'Unauthorized');
        }

        $profile = DB::table('user_profiles')
            ->join('users', 'user_profiles.user_id', '=', 'users.id')
            ->select(
                'user_profiles.*',
                'users.name as full_name',
                'users.email'
            )
            ->where('user_profiles.user_id', $id)
            ->first();

        if (!$profile) {
            return redirect()->back()->with('error', 'User profile not found.');
        }

        return view('staff.admission.user-profile-details', compact('profile'));
    }

    /**
     * Verify a user profile.
     */
    public function verify(Request $request, $id)
    {
        // Check if user is admission manager
        if (auth()->user()->role !== 'staff' || auth()->user()->manager_type !== 'admission') {
            abort(403, 'Unauthorized');
        }

        try {
            $updated = DB::table('user_profiles')
                ->where('user_id', $id)
                ->update([
                    'verification_status' => 'verified',
                    'verified_at' => now(),
                    'verified_by' => Auth::id(),
                    'updated_at' => now()
                ]);

            if ($updated) {
                return redirect()->back()->with('success', 'User profile verified successfully!');
            } else {
                return redirect()->back()->with('error', 'User profile not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error verifying profile: ' . $e->getMessage());
        }
    }

    /**
     * Reject a user profile.
     */
    public function reject(Request $request, $id)
    {
        // Check if user is admission manager
        if (auth()->user()->role !== 'staff' || auth()->user()->manager_type !== 'admission') {
            abort(403, 'Unauthorized');
        }

        try {
            $updated = DB::table('user_profiles')
                ->where('user_id', $id)
                ->update([
                    'verification_status' => 'rejected',
                    'verified_at' => now(),
                    'verified_by' => Auth::id(),
                    'updated_at' => now()
                ]);

            if ($updated) {
                return redirect()->back()->with('success', 'User profile rejected successfully!');
            } else {
                return redirect()->back()->with('error', 'User profile not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error rejecting profile: ' . $e->getMessage());
        }
    }

    /**
     * View IC file for verification
     */
    public function viewIC($id)
    {
        // Check if user is admission manager
        if (auth()->user()->role !== 'staff' || auth()->user()->manager_type !== 'admission') {
            abort(403, 'Unauthorized');
        }

        $profile = DB::table('user_profiles')->where('user_id', $id)->first();
        
        if (!$profile || !$profile->ic_file_path) {
            return response()->json(['error' => 'IC file not found'], 404);
        }

        if (!Storage::disk('private')->exists($profile->ic_file_path)) {
            return response()->json(['error' => 'IC file no longer exists on server'], 404);
        }

        $file = Storage::disk('private')->get($profile->ic_file_path);
        $mimeType = Storage::disk('private')->mimeType($profile->ic_file_path);

        return response($file, 200)->header('Content-Type', $mimeType);
    }
}