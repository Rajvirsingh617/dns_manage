<?php


namespace App\Http\Controllers;
use App\Models\DnsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Show the change password form
    public function showChangePasswordForm()
    {
        return view('layouts.change-password');
    }

    public function updatePassword(Request $request)
{
    // Validate the input with a stronger password rule (if needed)
    $request->validate([
        'password_old' => 'required|string|min:6',
        'password_one' => 'required|string|min:6|confirmed', // Require a minimum length and confirmation
    ]);

    // Get the currently authenticated user
    $user = Auth::user();

    // Check if the old password matches the stored hash
    $oldPassword = trim($request->password_old);
    $storedPassword = trim($user->password);

    if (!Hash::check($oldPassword, $storedPassword)) {
        return back()->withErrors(['password_old' => 'The old password is incorrect.']);
    }

    // Update the password securely
    try {
        $user->password = Hash::make($request->password_one);
        $user->save();

        // Redirect to the dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Your password has been updated successfully!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Failed to update the password. Please try again later.']);
    }
}  

}

