<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
{
    // Count the zones for the logged-in user
    $zoneCount = Zone::where('owner', Auth::id())->count();

    // Pass the $zoneCount to the view
    return view('layouts.dashboard', compact('zoneCount'));
}

}
