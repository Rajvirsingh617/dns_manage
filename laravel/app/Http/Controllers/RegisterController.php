<?php

namespace App\Http\Controllers;

use App\Models\DnsUser;  // Make sure you are using the correct model for your table
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show the registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string|max:255|unique:dns_users,username', // Ensure username is unique in the table
            'email' => 'required|email|unique:dns_users,email',  // Ensure email is unique
            'password' => 'required|string|min:6|confirmed',  // Confirm password and enforce minimum length
        ]);

        // Create a new user in the database
        DnsUser::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password before storing
        ]);

        // Redirect to login page after successful registration
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }
}


