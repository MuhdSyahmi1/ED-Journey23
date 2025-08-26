<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Display the profile form
     */
    public function index()
    {
        $profile = DB::table('user_profiles')->where('user_id', Auth::id())->first();
        return view('user.profile', compact('profile'));
    }

    /**
     * Store or update user profile
     */
    public function store(Request $request)
    {
        $request->validate([
            'ic_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB max
            'name' => 'required|string|max:255',
            'identity_card' => 'required|string|max:8|regex:/^[0-9]{1,8}$/',
            'id_color' => 'required|in:yellow,green,red',
            'postal_address' => 'required|string|max:500',
            'date_of_birth' => 'required|date|before:today',
            'place_of_birth' => 'required|string|max:255',
            'telephone_home' => 'required|string|max:20',
            'mobile_phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'religion' => 'required|in:islam,christianity,buddhism,hinduism,other',
            'nationality' => 'required|string|max:100',
            'race' => 'required|in:brunei,malay,chinese,indian,other',
            'email_address' => [
                'required',
                'email',
                'max:255',
                Rule::unique('user_profiles')->where(function ($query) {
                    return $query->where('user_id', '!=', Auth::id());
                })
            ],
            'health_record' => 'nullable|string|max:1000'
        ], [
            'ic_file.mimes' => 'IC file must be a JPG, PNG, or PDF file.',
            'ic_file.max' => 'IC file must not exceed 5MB.',
            'identity_card.regex' => 'Identity card must contain only numbers and be maximum 8 digits.',
            'date_of_birth.before' => 'Date of birth must be a valid past date.',
            'email_address.unique' => 'This email address is already taken by another user.',
        ]);

        try {
            $data = [
                'user_id' => Auth::id(),
                'name' => $request->name,
                'identity_card' => $request->identity_card,
                'id_color' => $request->id_color,
                'postal_address' => $request->postal_address,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'telephone_home' => $request->telephone_home,
                'mobile_phone' => $request->mobile_phone,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'race' => $request->race,
                'email_address' => $request->email_address,
                'health_record' => $request->health_record,
                'updated_at' => now()
            ];

            // Handle IC file upload
            if ($request->hasFile('ic_file')) {
                // Delete old file if exists
                $existingProfile = DB::table('user_profiles')->where('user_id', Auth::id())->first();
                if ($existingProfile && $existingProfile->ic_file_path) {
                    Storage::delete($existingProfile->ic_file_path);
                }

                // Store new file
                $filePath = $request->file('ic_file')->store('ic_files', 'private');
                $data['ic_file_path'] = $filePath;
                $data['ic_file_name'] = $request->file('ic_file')->getClientOriginalName();
            }

            // Check if profile exists
            $existingProfile = DB::table('user_profiles')->where('user_id', Auth::id())->first();

            if ($existingProfile) {
                // Update existing profile
                DB::table('user_profiles')
                    ->where('user_id', Auth::id())
                    ->update($data);
            } else {
                // Create new profile
                $data['created_at'] = now();
                DB::table('user_profiles')->insert($data);
            }

            // Update user's name and email in users table if changed
            $user = Auth::user();
            $userUpdates = [];
            
            if ($user->name !== $request->name) {
                $userUpdates['name'] = $request->name;
            }
            
            if ($user->email !== $request->email_address) {
                $userUpdates['email'] = $request->email_address;
            }

            if (!empty($userUpdates)) {
                $userUpdates['updated_at'] = now();
                DB::table('users')->where('id', Auth::id())->update($userUpdates);
            }

            return redirect()->route('user.profile')
                ->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating profile: ' . $e->getMessage());
        }
    }

    /**
     * Get profile completion percentage
     */
    public function getProgress()
    {
        $profile = DB::table('user_profiles')->where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return response()->json(['progress' => 0, 'completed' => false]);
        }

        // Define required fields (excluding optional health_record)
        $requiredFields = [
            'ic_file_path', 'name', 'identity_card', 'id_color', 'postal_address',
            'date_of_birth', 'place_of_birth', 'telephone_home', 'mobile_phone',
            'gender', 'religion', 'nationality', 'race', 'email_address'
        ];

        $completedFields = 0;
        foreach ($requiredFields as $field) {
            if (!empty($profile->$field)) {
                $completedFields++;
            }
        }

        $progress = round(($completedFields / count($requiredFields)) * 100);

        return response()->json([
            'progress' => $progress,
            'completed' => $progress === 100,
            'completed_fields' => $completedFields,
            'total_fields' => count($requiredFields)
        ]);
    }

    /**
     * Download IC file
     */
    public function downloadIC()
    {
        $profile = DB::table('user_profiles')->where('user_id', Auth::id())->first();
        
        if (!$profile || !$profile->ic_file_path) {
            return redirect()->back()->with('error', 'IC file not found.');
        }

        if (!Storage::exists($profile->ic_file_path)) {
            return redirect()->back()->with('error', 'IC file no longer exists on server.');
        }

        return Storage::download($profile->ic_file_path, $profile->ic_file_name);
    }
}