<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\ZoneRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ZoneController extends Controller
{
    
    public function index() 
{
    if (auth()->user()->role === 'admin') {      
        $zones = Zone::with('user')->paginate(10); // Corrected the typo here
    } else {   
        $zones = Zone::where('owner', auth()->id())->paginate(10);
    }
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
        'name' => ['required','unique:zones,name','regex:/^[a-z]/',], // Ensures the zone name is unique
        'refresh' => 'required',
        'retry' => 'required',
        'expire' => 'required',
        'ttl' => 'required',
        'pri_dns' => 'required|string',
        'sec_dns' => 'required|string',
        'user_id' => 'nullable|exists:dns_users,id',
    ]);

    // Check if the zone already exists
    $existingZone = Zone::where('name', $request->name)->first();
    if ($existingZone) {
        // If zone already exists, return error
        return back()->with('error', 'The zone already exists in the database.');
    }
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
    // लॉगिन यूजर का ID स्टोर करें
   

    if (auth()->user()->isAdmin() && $request->user_id) {
        $zone->owner = $request->user_id; // Store the selected user's ID as the owner
    } else {
        $zone->owner = Auth::id(); // Store the logged-in user's ID as the owner
    }
    $zone->save();
    return redirect()->route('zones.index')->with('success', 'Zone added successfully!');
}
    
    public function create()
    {
        // Return the create zone view
        $users = User::where('role', '!=', 'admin')->get();
        return view('zones.newzone', compact('users')); 
    }

    public function destroy($id)
    {
        // Find the zone by ID and delete it
        $zone = Zone::findOrFail($id);
        $zone->delete();

        // Redirect back with a success message
        return redirect()->route('zones.index')->with('success', 'Zone deleted successfully.');
    }
    public function edit($id)
    {
        // Find the zone by ID and pass it to the edit view
        $zone = Zone::with('records')->findOrFail($id);
        $users = User::all();
        return view('zones.editzone', compact('zone','users'));
    }
    public function update(Request $request, $id)
    {
        // Find the Zone by its ID
        $zone = Zone::findOrFail($id);
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'refresh' => 'required|integer',
            'retry' => 'required|integer',
            'expire' => 'required|integer',
            'ttl' => 'required|integer',
            'pri_dns' => 'required|string',
            'sec_dns' => 'required|string',
            'owner' => 'required|exists:dns_users,id',
        ]);
        $zone->update($request->only(['refresh', 'retry', 'expire', 'ttl', 'pri_dns', 'sec_dns', 'owner']));
        // Update the Zone with the new data
        $zone->update([
            'name' => $request->name,
            'refresh' => $request->refresh,
            'retry' => $request->retry,
            'expire' => $request->expire,
            'ttl' => $request->ttl,
            'pri_dns' => $request->pri_dns,
            'sec_dns' => $request->sec_dns,
            'owner' => $request->owner,
        ]);
       
        $data = $request->only(['name', 'refresh', 'retry', 'expire', 'ttl', 'pri_dns', 'sec_dns', 'owner']);
     // Confirm the data being passed to the update method
        $zone->update($data);
        // Redirect with a success message
        return redirect()->route('zones.index')->with('success', 'Zone updated successfully!');
    }
        public function updateRecords(Request $request, $id)
        {
            // Find the Zone by its ID
            $zone = Zone::findOrFail($id);

        if ($request->has('host')) {
            foreach ($request->host as $key => $host) {
                $record = $zone->records()->find($request->record_id[$key]);
                if ($record) {
                    $record->update([
                        'host' => $host,
                        'type' => $request->type[$key],
                        'destination' => $request->destination[$key],
                    ]);
    
                    // Handle deletion if checkbox is checked
                    if (isset($request->delete[$key])) {
                        $record->delete();
                    }
                }
            }
        }
    
        // Add new record if provided
        if ($request->filled(['newhost', 'newtype', 'newdestination'])) {
            $zone->records()->create([
                'host' => $request->newhost,
                'type' => $request->newtype,
                'destination' => $request->newdestination,
            ]);
        }
    
        return back()->with('success', 'Zone updated successfully!');
    }
}
