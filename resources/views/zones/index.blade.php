@extends('layouts.app')

@section('content')
<style>
table {
    table-layout: auto; /* Allows column width to adjust based on content */
}


</style>
<h1>Zones</h1>

    
    <p> <b><i class="fa-solid fa-info"></i></b> You need to set your domain nameservers to:</p>
    <div>
        <ul>
            <li>ns1.centos-webpanel.com</li>
            <li>ns2.centos-webpanel.com</li>
            <li>ns3.centos-webpanel.com</li>
            <li>ns4.centos-webpanel.com</li>
            <li>ns5.centos-webpanel.com</li>
        </ul>
    </div>
   
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Serial</th>
                <th>User</th>
                <th>Changed</th>
                <th>Valid</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zones as $zone)
                <tr>
                    <td>{{ $zone->name }}</td>
                    <td>{{ $zone->serial }}</td>
                    <td>{{ $zone->user }}</td>
                    <td>
                        <span class="badge badge-success">✔</span>
                    </td>
                    <td>
                        <span class="badge badge-danger">✘</span>
                    </td>
                    <td>
                        <form action="{{ route('zones.destroy', $zone->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('zones.create') }}" class="btn btn-primary">Create a new zone</a>
</div>
@endsection
