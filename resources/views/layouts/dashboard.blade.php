@extends('layouts.app')

@section('content')


    
    <!-- Row 1: Cards -->
    <div class="container-fluid">
        <!-- Row 1: Cards -->
        <div class="container mt-2">
            <div class="row">
                <!-- Box 1: DNS Services Status -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-4" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">DNS Services Status</h5>
                            <p class="card-text">Started</p>
                        </div>
                    </div>
                </div>
        
                <!-- Box 2: Zones Maintained -->
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">You Maintain</h5>
                            <p class="card-text">2 Zones</p>
                        </div>
                    </div>
                </div>
        
                <!-- Box 3: Buy New Domains -->
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Buy</h5>
                            <p class="card-text">New Domains</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Row 2: Warning -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
                <strong>WARNING:</strong> The following zones contain bad or uncommitted records:
                <ul>
                    <li>rajvirsingh.com</li>
                    <li>raj.com</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
