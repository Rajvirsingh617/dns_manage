@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-6">
            <h1 class="text-dark">Change Password</h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('zones.index') }}">Main</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </div>
    </div>

    <div class="custom-box" style="margin-bottom:50px;margin-top:20px;border-top: 5px solid #007bff">
        <div class="card-body">
            <!-- Change Password Form -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="form-group row">
                    <label for="password_old" class="col-md-3 col-form-label"><strong>Old Password</strong></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control @error('password_old') is-invalid @enderror" id="password_old" name="password_old" placeholder="Enter your old password">
                        @error('password_old')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_one" class="col-md-3 col-form-label"><strong>New Password</strong></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control @error('password_one') is-invalid @enderror" id="password_one" name="password_one" placeholder="Enter a new password">
                        @error('password_one')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirm_password" class="col-md-3 col-form-label"><strong>Confirm Password</strong></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password" name="password_confirmation" placeholder="Confirm your new password">
                        @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
