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

    // Handle the password update logic
    // Handle the password update logic
 

    public function updatePassword(Request $request)
{
    // Validate the input
    $request->validate([
        'password_old' => 'required|string|min:6',
        'password_one' => 'required|string|min:6|confirmed',  // Ensures the password matches confirmation
    ]);

    // Get the currently authenticated user
    $user = Auth::user();

    // Check if the old password matches the stored hash
    if (!Hash::check($request->password_old, $user->password)) {
        return back()->withErrors(['password_old' => 'The old password is incorrect.']);
    }

    // Update the password
    $user->password = Hash::make($request->password_one);
    $user->save();

    // Redirect to a specific page with a success message
    return redirect()->route('dashboard')->with('success', 'Your password has been updated successfully!');
}

    

    

}

