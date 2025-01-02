<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Show the change password form
    public function showChangePasswordForm()
    {
       /*  dd('Showing change-password form'); */
        return view('layouts.change-password');
    }

    // Handle the password update logic
    public function updatePassword(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'password_old' => 'required',
            'password_one' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if the old password matches
        if (!Hash::check($request->password_old, Auth::user()->password)) {
            return back()->withErrors(['password_old' => 'The old password is incorrect.'])->withInput();
        }

        // Update the password
        $user = Auth::user();
        $user->password = Hash::make($request->password_one);
        $user->save();

        return redirect()->route('password.change')->with('success', 'Password updated successfully!');
    }
}
