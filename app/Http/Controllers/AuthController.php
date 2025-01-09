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
        $role = Auth::user()->role;
        return redirect()->intended('/dashboard')->with('popup', 'Login successful!');
    }
    // If authentication fails, redirect back with an error message
    return back()->withErrors(['login' => 'Invalid username or password.'])->withInput();
    }
    // Logout User

    public function logout()
    {
    Auth::logout();
    session()->forget('username');
    return redirect('/login');
    }

    public function getRoleAttribute()
    {
    return $this->attributes['role']; // Assuming the 'role' column exists in the database
    }
    public function showResetPasswordForm($token)
    {
        return view('auth.resetpassword', compact('token'));
    }

    // Handle the reset password request
    public function resetPassword(Request $request)
    {
        // Validate the form input
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Assuming you use a Token-based password reset approach, validate the token here
        // Update the user's password
        $user = User::where('email', $request->email)->first(); // Example: retrieve user by email
        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('login')->with('success', 'Password reset successfully.');
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}


