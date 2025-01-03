@extends('layouts.app')

@section('content')
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupModalLabel">Welcome</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ session('popup') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-15">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index.php">Main</a></li>
        <li class="breadcrumb-item">Main</li>
    </ol>
</div>
<div class="col-sm-6">
    <h1 class="m-0 text-dark" style="text-align: left !important; margin-bottom: 20px;">Main</h1>
</div>

<div class="custom-box" style="margin-bottom:50px;margin-top:20px;border-top: 5px solid #007bff">
    <div class="col-sm-15">
        <div class="row">
            <div class="col-md-6">
                @if(Auth::check())
                    <h3>Welcome, <b>{{ Auth::user()->username }}</b></h3>
                @else
                    <h3>Welcome, Guest</h3>
                @endif

            </div>
            
            
            
        </div>
    </div>
    <div class="container-fluid">
    <div class="row">
        <!-- First Info Box -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number" style="font-weight: bold;">DNS Services Status</span>
                    <span class="info-box-text" style="font-weight: bold;">Started</span>
                </div>
            </div>
        </div>
        
        <!-- Second Info Box -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-warning">
                <span class="info-box-icon" style="color: black;">
                    <i class="fas fa-table"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-number" style="font-weight: bold; color: black;">You Maintain</span>
                    <span class="info-box-text" style="font-weight: bold; color: black;">
                        {{ $zoneCount }} Zones
                    </span>
                </div>
            </div>
        </div>
        
        
        
        <!-- Third Info Box -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
                <span class="info-box-icon">
                    <a href="http://secure.studio4host.com/user/domainchecker.php" target="_blank" style="color:#fff">
                        <i class="fa fa-cart-plus"></i>
                    </a>
                </span>
                <div class="info-box-content">
                    <span class="info-box-number" style="font-weight: bold;">
                        <a href="http://secure.studio4host.com/user/domainchecker.php" target="_blank" style="color:#fff">
                            Buy
                        </a>
                    </span>
                    <span class="info-box-text" style="font-weight: bold;">New Domains</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('popup'))
            $('#popupModal').modal('show');
        @endif
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
