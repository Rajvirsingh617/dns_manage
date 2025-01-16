<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\ZoneRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


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
    // Validate fields specific to the zone
        $request->validate([
            'name' => ['required', 'unique:zones,name', 'regex:/^[a-z]/'], // Ensures the zone name is unique
            'refresh' => 'required|integer',
            'retry' => 'required|integer',
            'expire' => 'required|integer',
            'ttl' => 'required|integer',
            'pri_dns' => 'required|string',
            'sec_dns' => 'required|string',
            'www' => 'nullable|string|max:255',
            'mail' => 'nullable|string|max:255',
            'ftp' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:dns_users,id',
    ]);

    // Check if the zone already exists
            $existingZone = Zone::where('name', $request->name)->first();
            if ($existingZone) {
                return back()->with('error', 'The zone already exists in the database.');
            }

    // Create the zone
        $zone = new Zone();
        $zone->name = $request->name;
        $zone->refresh = $request->refresh;
        $zone->retry = $request->retry;
        $zone->expire = $request->expire;
        $zone->ttl = $request->ttl;
        $zone->pri_dns = $request->pri_dns;
        $zone->sec_dns = $request->sec_dns;
        $zone->www = $request->www; // Assigning www field
        $zone->mail = $request->mail; // Assigning mail field
        $zone->ftp = $request->ftp; // Assigning ftp field
        /* $zone->owner = auth()->user()->isAdmin() && $request->user_id ? $request->user_id : Auth::id();  */// Assigning owner field

        if (auth()->user()->isAdmin() && $request->user_id) {
            $zone->owner = $request->user_id;
        } else {
            $zone->owner = Auth::id();
        }

        $zone->save();

    // Check if record fields are provided
        if ($request->has(['host', 'type', 'destination'])) {
            $request->validate([
                'host' => 'required|string|max:255|regex:/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/',
                'type' => 'required|in:A,AAAA,AFSDB,CNAME,DNAME,DS,LOC,MX,NAPTR,NS,PTR,RP,SRV,SSHFP,TXT,WKS',
                'destination' => 'required|string|max:255',
            ]);

        // Add the first record for the zone
            $zone->records()->create([
                'host' => $request->host,
                'type' => $request->type,
                'destination' => $request->destination,
            ]);
    }

        return redirect()->route('zones.index')->with('success', 'Zone and record added successfully!');
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
            'www' => 'nullable|string|max:255',
            'mail' => 'nullable|string|max:255',
            'ftp' => 'nullable|string|max:255',
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
                'www' => $request->www,
                'mail' => $request->mail,
                'ftp' => $request->ftp,
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
                $type = $request->type[$key];
                $destination = $request->destination[$key];

                // Validation rules for each record
                $validator = Validator::make([
                    'host' => $host,
                    'type' => $type,
                    'destination' => $destination,
                ], [
                    'host' => ['required', 'string', 'regex:/^([a-zA-Z0-9-]+\\.)*[a-zA-Z0-9-]+$/'],
                    'type' => ['required', 'in:A,AAAA,CNAME,AFSDB,DNAME,DS,LOC,MX,NAPTR,NS,PTR,RP,SRV,SSHFP,TXT,WKS'],
                    'destination' => $this->getDestinationValidationRule($type),
                ]);

                // If validation fails, skip this record
                if ($validator->fails()) {
                    continue; // Or log the error if necessary
                }

                $record = $zone->records()->find($request->record_id[$key]);
                if ($record) {
                    $record->update([
                        'host' => $host,
                        'type' => $type,
                        'destination' => $destination,
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
            $validator = Validator::make([
                'host' => $request->newhost,
                'type' => $request->newtype,
                'destination' => $request->newdestination,
            ], [
                'host' => ['required', 'string', 'regex:/^([a-zA-Z0-9-]+\\.)*[a-zA-Z0-9-]+$/'],
                'type' => ['required', 'in:A,AAAA,CNAME,DNAME,AFSDB,DS,LOC,MX,NAPTR,NS,PTR,RP,SRV,SSHFP,TXT,WKS'],
                'destination' => $this->getDestinationValidationRule($request->newtype),
            ]);

            if ($validator->passes()) {
                $zone->records()->create([
                    'host' => $request->newhost,
                    'type' => $request->newtype,
                    'destination' => $request->newdestination,
                ]);
            }
        }    

        return back()->with('success', 'Zone updated successfully!');
    }
    private function getDestinationValidationRule($type)
    {
        switch ($type) {
            case 'A':
                // IPv4 address validation
                return ['required', 'ipv4'];

            case 'AAAA':
                // IPv6 address validation
                return ['required', 'ipv6'];

            case 'CNAME':
            case 'DNAME':
            case 'NS':
            case 'PTR':
                // Domain name validation
                return ['required', 'string', 'regex:/^([a-zA-Z0-9-]+\\.)+[a-zA-Z]{2,}$/'];

            case 'MX':
                // Mail server priority and domain name validation
                // Example: "10 mail.example.com"
                return ['required', 'string', 'regex:/^\\d+\\s([a-zA-Z0-9-]+\\.)+[a-zA-Z]{2,}$/'];

            case 'TXT':
                // Free-form text validation
                return ['required', 'string'];

            case 'LOC':
                // Geographic location in the format: "37 23 30.0 N 121 58 21.0 W 10m"
                return ['required', 'regex:/^(\\d{1,2}\\s\\d{1,2}\\s\\d{1,2}\\.[0-9]+\\s[N|S]\\s\\d{1,3}\\s\\d{1,2}\\s\\d{1,2}\\.[0-9]+\\s[W|E]\\s\\d+m)$/'];

            case 'SRV':
                // Service record format: "10 5 5060 sipserver.example.com"
                return ['required', 'regex:/^\\d+\\s\\d+\\s\\d+\\s([a-zA-Z0-9-]+\\.)+[a-zA-Z]{2,}$/'];

            case 'SSHFP':
                // SSHFP: Algorithm, Fingerprint Type, Fingerprint
                return ['required', 'string', 'regex:/^\\d+\\s\\d+\\s[a-fA-F0-9]{40,64}$/'];

            case 'DS':
                // DNSSEC Delegation Signer: Key Tag, Algorithm, Digest Type, Digest
                return ['required', 'string', 'regex:/^\\d+\\s\\d+\\s\\d+\\s[a-fA-F0-9]+$/'];

            case 'NAPTR':
                // NAPTR: Order, Preference, Flags, Service, Regexp, Replacement
                return ['required', 'string', 'regex:/^\\d+\\s\\d+\\s\\\"[a-zA-Z0-9]+\\\"\\s\\\"[a-zA-Z0-9]+\\\"\\s\\\".*\\\"\\s([a-zA-Z0-9-]+\\.)+[a-zA-Z]{2,}$/'];

            case 'RP':
                // Responsible Person: email address (in DNS format) and TXT record pointer
                return ['required', 'string', 'regex:/^([a-zA-Z0-9-]+\\.)+[a-zA-Z]{2,}\\s([a-zA-Z0-9-]+\\.)+[a-zA-Z]{2,}$/'];

            case 'WKS':
                // Well-Known Services: Protocol, IP, Service Map
                return ['required', 'string']; // Adjust based on specific WKS usage (rarely used)

            default:
                // Default fallback for any unhandled types
                return ['required', 'string'];
        }
    }
    public function indexApi()
    {
        $zones = Zone::all();
        return response()->json($zones, 200);
    }

    public function showApi($id)
    {
        $zone = Zone::find($id);

       
        if  (!$zone) {
            return response()->json([
                'status' => 'error',
                'message' => 'Zone not found',
            ], 404);
            
        }

        return response()->json($zone, 200);
    }

    public function storeApi(Request $request)
    {
    $apiKey = $request->header('Authorization');
    $apiKey = str_replace('Bearer ', '', $apiKey);

    $user = Auth::user(); // Fetch authenticated user

    if (!$user || $user->api_token !== $apiKey) {
        return response()->json(['error' => 'Unauthorized. Invalid API Key.'], 401);
    }

    $validated = $request->validate([
        'name' => 'required|unique:zones,name',
        'refresh' => 'required|integer',
        'retry' => 'required|integer',
        'expire' => 'required|integer',
        'ttl' => 'required|integer',
        'pri_dns' => 'required|string',
        'sec_dns' => 'required|string',
        'www' => 'nullable|string|max:255',
        'mail' => 'nullable|string|max:255',
        'ftp' => 'nullable|string|max:255',
    ]);

    $validated['owner'] = $user->id;

    // Create the zone with the validated data
    $zone = \App\Models\Zone::create($validated);

    return response()->json($zone, 201);
}


    public function updateApi(Request $request, $id)
    {
    // Extract API key from Authorization header
    $apiKey = $request->header('Authorization');
    $apiKey = str_replace('Bearer ', '', $apiKey);

    // Find the authenticated user by API token
    $user = \App\Models\User::where('api_token', $apiKey)->first();

    // Check if user exists and is authenticated
    if (!$user) {
        return response()->json(['error' => 'Unauthorized. Invalid API Key.'], 401);
    }

    // Find the zone by ID
    $zone = \App\Models\Zone::find($id);

    // Check if the zone exists
    if (!$zone) {
        return response()->json(['error' => 'Zone not found'], 404);
    }

    // Ensure the authenticated user is the owner of the zone
    if ($zone->owner !== $user->id) {
        return response()->json(['error' => 'You are not authorized to update this zone'], 403);
    }

    // Validate the incoming request data
    $validated = $request->validate([
        'name' => 'sometimes|required|unique:zones,name,' . $zone->id,
        'refresh' => 'sometimes|required|integer',
        'retry' => 'sometimes|required|integer',
        'expire' => 'sometimes|required|integer',
        'ttl' => 'sometimes|required|integer',
        'pri_dns' => 'sometimes|required|string',
        'sec_dns' => 'sometimes|required|string',
        'www' => 'nullable|string',
        'mail' => 'nullable|string',
        'ftp' => 'nullable|string',
    ]);

    // Update the zone with the validated data
    $zone->update($validated);

    return response()->json($zone, 200);
    }


    public function destroyApi($id)
    {
        $zone = Zone::find($id);

        if (!$zone) {
            return response()->json(['error' => 'Zone not found'], 404);
        }

        $zone->delete();

        return response()->json(['message' => 'Zone deleted successfully'], 200);
    }

    public function storeRecordApi(Request $request, $uuid)
{
    $apiKey = $request->header('Authorization');
    $apiKey = str_replace('Bearer ', '', $apiKey);

    $user = Auth::user(); // Fetch authenticated user

    if (!$user || $user->api_token !== $apiKey) {
        return response()->json(['error' => 'Unauthorized. Invalid API Key.'], 401);
    }

    // Validate the request data
    $validated = $request->validate([
        'host' => [
            'required',
            'string',
            'max:255',
            'regex:/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])$/'
        ],
        'type' => 'required|in:A,AAAA,CNAME,DNAME,DS,LOC,MX,NAPTR,NS,PTR,RP,SRV,SSHFP,TXT,WKS',
        'destination' => $this->getDestinationValidationRule($request->newtype),
    ]);

    // Find the zone by UUID
    $zone = \App\Models\Zone::where('uuid', $uuid)->first();

    if (!$zone) {
        return response()->json(['error' => 'Zone not found'], 404);
    }

    // Ensure the user has access to the zone
    if ($zone->owner !== $user->id) {
        return response()->json(['error' => 'Unauthorized to add records for this zone'], 403);
    }

    // Add the record to the zone
    $record = $zone->records()->create($validated);

    return response()->json(['message' => 'Record added successfully', 'record' => $record], 201);
}
    
    public function indexRecordsApi($uuid)
{
    $zone = Zone::where('uuid', $uuid)->first();

    if (!$zone) {
        return response()->json(['error' => 'Zone not found'], 404);
    }

    $records = $zone->records;

    return response()->json(['zone' => $zone, 'records' => $records], 200);
}
    
public function updateRecordApi(Request $request, $uuid, $recordId)
{
    $apiKey = $request->header('Authorization');
    $apiKey = str_replace('Bearer ', '', $apiKey);

    $user = Auth::user();

    if (!$user || $user->api_token !== $apiKey) {
        return response()->json(['error' => 'Unauthorized. Invalid API Key.'], 401);
    }

    // Find the zone by UUID
    $zone = Zone::where('uuid', $uuid)->first();

    if (!$zone) {
        return response()->json(['error' => 'Zone not found.'], 404);
    }

    if ($zone->owner !== $user->id) {
        return response()->json(['error' => 'Unauthorized to update records for this zone.'], 403);
    }

    // Debug: Check if record query works
    $record = $zone->records()->where('id', $recordId)->first();
    if (!$record) {
        return response()->json([
            'error' => 'Record not found.',
            'zone_id' => $zone->id,
            'record_id' => $recordId,
            'all_records' => $zone->records
        ], 404);
    }

    // Validate the request payload
    $validated = $request->validate([
        'host' => 'nullable|string|max:255',
        'type' => 'nullable|in:A,AAAA,CNAME,DNAME,DS,LOC,MX,NAPTR,NS,PTR,RP,SRV,SSHFP,TXT,WKS',
        'destination' => 'nullable|string|max:255',
        'valid' => 'nullable|boolean',
    ]);

    $record->update($validated);

    return response()->json(['message' => 'Record updated successfully.', 'record' => $record], 200);
}


    // Delete a specific record
    public function deleteRecordApi(Request $request, $uuid, $recordId)
    {
        $apiKey = $request->header('Authorization');
        $apiKey = str_replace('Bearer ', '', $apiKey);

        $user = Auth::user();

        if (!$user || $user->api_token !== $apiKey) {
            return response()->json(['error' => 'Unauthorized. Invalid API Key.'], 401);
        }

        $zone = Zone::where('uuid', $uuid)->first();

        if (!$zone) {
            return response()->json(['error' => 'Zone not found'], 404);
        }

        if ($zone->owner !== $user->id) {
            return response()->json(['error' => 'Unauthorized to delete records for this zone'], 403);
        }

        $record = $zone->records()->where('id', $recordId)->first();

        if (!$record) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
    
}