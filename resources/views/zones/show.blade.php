@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Zone Details</h1>
    <p><strong>Name:</strong> {{ $zone->name }}</p>
    <p><strong>Serial:</strong> {{ $zone->serial }}</p>
    <p><strong>User:</strong> {{ $zone->user }}</p>
</div>
@endsection
