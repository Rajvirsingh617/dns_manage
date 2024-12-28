@extends('layouts.app')

@section('content')
<div class="col-sm-10">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index.php">Main</a></li>
        <li class="breadcrumb-item">Main</li>
    </ol>
</div>
<div class="col-sm-6">
    <h1 class="m-0 text-dark" style="text-align: left !important; margin-bottom: 20px;">Main</h1>
</div>


<div class="custom-box" style="margin-bottom: 50px;">
    <div class="col-sm-15">
        <div class="row">
            <div class="col-md-6">
                <h3 style="text-align: left !important; margin-top: 20px;">Welcome, <b>RAJVIRSINGH.</b></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- First Info Box -->
        <div class="col-md-4 col-sm-6">
            <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">DNS Services Status</span>
                    <span class="info-box-text">Started</span>
                </div>
            </div>
        </div>
        <!-- Second Info Box -->
        <div class="col-md-4 col-sm-6">
            <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="fas fa-table"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">You Maintain</span>
                    <span class="info-box-text">2 Zones</span>
                </div>
            </div>
        </div>
        <!-- Third Info Box -->
        <div class="col-md-4 col-sm-6">
            <div class="info-box bg-gradient-info">
                <span class="info-box-icon">
                    <a href="http://secure.studio4host.com/user/domainchecker.php" target="_blank" style="color:#fff">
                        <i class="fa fa-cart-plus"></i>
                    </a>
                </span>
                <div class="info-box-content">
                    <span class="info-box-number">
                        <a href="http://secure.studio4host.com/user/domainchecker.php" target="_blank" style="color:#fff">
                            Buy
                        </a>
                    </span>
                    <span class="info-box-text">New Domains</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-box {
        border-top: 5px solid blue; /* Blue top border */
        background: #fff; /* Optional: Set a background color */
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
        border-radius: 8px; /* Optional: Round the corners */
        color: #000; /* Optional: Adjust text color */
        padding: 15px; /* Optional: Adjust padding */
        margin-bottom: 30px; /* Optional: Add spacing between sections */
    }
</style>


@endsection