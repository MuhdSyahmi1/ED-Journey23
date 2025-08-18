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
        $this->middleware(['auth', 'role:Admin']);
    }

    public function createStaff(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Staff',
        ]);

        return redirect()->back()->with('success', 'Staff created!');
    }
}
