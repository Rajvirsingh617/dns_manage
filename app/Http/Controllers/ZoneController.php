<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;

class ZoneController extends Controller
{
    //
    public function index()
    {
       
        $zoneCount = Zone::where('owner', Auth::id())->count();
       
        $zones = Zone::where('owner', Auth::id())->get();
    
       
        return view('zones.index', compact('zones', 'zoneCount'));
    }
    

public function show($id)
{
    $zone = Zone::findOrFail($id); // Ensure the Zone model is imported at the top
    return view('zones.show', compact('zone')); // Create the `zones/show.blade.php` file
}




public function store(Request $request)
{
    $zone = new Zone();
    $zone->name = $request->name;
    $zone->refresh = $request->refresh;
    $zone->retry = $request->retry;
    $zone->expire = $request->expire;
    $zone->ttl = $request->ttl;
    $zone->pri_dns = $request->pri_dns;
    $zone->sec_dns = $request->sec_dns;
    $zone->www = $request->www;
    $zone->mail = $request->mail;
    $zone->ftp = $request->ftp;
    $zone->owner = Auth::id(); // लॉगिन यूजर का ID स्टोर करें
    $zone->save();

    return redirect()->route('zones.index')->with('success', 'Zone added successfully!');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create zone view
        return view('zones.newzone');
    }

    public function destroy($id)
    {
        // Find the zone by ID and delete it
        $zone = Zone::findOrFail($id);
        $zone->delete();

        // Redirect back with a success message
        return redirect()->route('zones.index')->with('success', 'Zone deleted successfully.');
    }
}


