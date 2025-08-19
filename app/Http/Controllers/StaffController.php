<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    // Only Admin can access this controller
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    // Show the create staff form
    public function showCreateForm()
    {
        return view('admin.CreateStaff'); // Updated to match your file path
    }

    // Handle creating new staff
    public function createStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        return redirect()->back()->with('success', 'Staff member created successfully!');
    }
}