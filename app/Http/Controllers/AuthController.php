<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login Request
    public function login(Request $request)
    {
        // Validate the login form input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log in the user with the given username and password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            // Redirect to a protected route (e.g., dashboard) after successful login
            return redirect()->intended('/dashboard')->with('success', 'Login successful!');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors(['login' => 'Invalid username or password.'])->withInput();
    }

    // Logout User
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect('/login'); // Redirect to the login page after logout
    }
}


