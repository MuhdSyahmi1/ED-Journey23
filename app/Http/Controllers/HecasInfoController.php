<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HecasInfoController extends Controller
{
    /**
     * Display the HECAS info page
     */
    public function index()
    {
        // Check if user is authenticated and is a regular user
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }

        // Get user profile with HECAS ID
        $profile = DB::table('user_profiles')
            ->where('user_id', auth()->id())
            ->first();

        return view('user.hecas-info', compact('profile'));
    }

    /**
     * Store or update HECAS ID
     */
    public function store(Request $request)
    {
        // Check if user is authenticated and is a regular user
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }

        // Validate HECAS ID format
        $request->validate([
            'hecas_id' => 'nullable|string|regex:/^[0-9]{2}\/[0-9]{8}\/[0-9]{2}$/'
        ], [
            'hecas_id.regex' => 'HECAS ID must follow the format: XX/XXXXXXXX/XX (e.g., 31/12345678/01)'
        ]);

        try {
            // Check if user profile exists
            $existingProfile = DB::table('user_profiles')
                ->where('user_id', auth()->id())
                ->first();

            if ($existingProfile) {
                // Update existing profile
                DB::table('user_profiles')
                    ->where('user_id', auth()->id())
                    ->update([
                        'hecas_id' => $request->hecas_id,
                        'updated_at' => now()
                    ]);
            } else {
                // Create new profile with minimal required data
                DB::table('user_profiles')->insert([
                    'user_id' => auth()->id(),
                    'hecas_id' => $request->hecas_id,
                    'name' => auth()->user()->name,
                    'email_address' => auth()->user()->email,
                    'verification_status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            $message = $request->hecas_id 
                ? 'HECAS ID has been saved successfully!'
                : 'HECAS ID has been cleared successfully!';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving HECAS information: ' . $e->getMessage());
        }
    }
}