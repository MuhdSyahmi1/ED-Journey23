<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserQuestionnaireController extends Controller
{
    /**
     * Display the questionnaire page
     */
    public function index()
    {
        // Check if user has already completed questionnaire
        $existingResponse = DB::table('user_questionnaire_responses')
            ->where('user_id', Auth::id())
            ->first();

        // If questionnaire is completed, redirect to results
        if ($existingResponse) {
            return redirect()->route('user.questionnaire.results');
        }

        // Otherwise show the questionnaire
        return view('user.questionnaire');
    }

    /**
     * Store questionnaire responses
     */
    public function store(Request $request)
    {
        $request->validate([
            'questionnaire' => 'required|array',
            'scores' => 'required|array',
            'recommended_school' => 'required|string'
        ]);

        try {
            // Check if user already has responses
            $existingResponse = DB::table('user_questionnaire_responses')
                ->where('user_id', Auth::id())
                ->first();

            $data = [
                'user_id' => Auth::id(),
                'responses' => json_encode($request->questionnaire),
                'scores' => json_encode($request->scores),
                'recommended_school' => $request->recommended_school,
                'completed_at' => now(),
                'updated_at' => now()
            ];

            if ($existingResponse) {
                // Update existing response
                DB::table('user_questionnaire_responses')
                    ->where('user_id', Auth::id())
                    ->update($data);
            } else {
                // Create new response
                $data['created_at'] = now();
                DB::table('user_questionnaire_responses')->insert($data);
            }

            return response()->json([
                'success' => true,
                'message' => 'Questionnaire submitted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error submitting questionnaire: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Allow user to retake the questionnaire
     */
    public function retake()
    {
        return view('user.questionnaire');
    }

    /**
     * Get user's questionnaire results
     */
    public function results()
    {
        $response = DB::table('user_questionnaire_responses')
            ->where('user_id', Auth::id())
            ->first();

        if (!$response) {
            return redirect()->route('user.questionnaire')
                ->with('error', 'Please complete the questionnaire first.');
        }

        $scores = json_decode($response->scores, true);
        $responses = json_decode($response->responses, true);

        return view('user.questionnaire-results', compact('response', 'scores', 'responses'));
    }

    /**
     * Get questionnaire progress for dashboard
     */
    public function getProgress()
    {
        $response = DB::table('user_questionnaire_responses')
            ->where('user_id', Auth::id())
            ->first();

        return response()->json([
            'completed' => !is_null($response),
            'progress' => $response ? 100 : 0,
            'completed_at' => $response ? $response->completed_at : null
        ]);
    }
}