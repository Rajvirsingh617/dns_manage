<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;


class ZoneController extends Controller
{
    //
    public function index()
{
    $zones = Zone::paginate(10); // Assuming a Zone model exists
    return view('zones.index', compact('zones'));
}
public function show($id)
{
    $zone = Zone::findOrFail($id); // Ensure the Zone model is imported at the top
    return view('zones.show', compact('zone')); // Create the `zones/show.blade.php` file
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'serial' => 'required',
        'user' => 'required',
    ]);

    Zone::create($request->all());
    return redirect()->route('zones.index')->with('success', 'Zone created successfully.');
}

}
