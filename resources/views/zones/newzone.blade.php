@extends('layouts.app')

@section('content')

<h1>New Zone</h1>
<div class="custom-box" style="margin-bottom: 50px; margin-top: 20px; border-top: 5px solid #007bff; padding-top: 15px;">
    <div class="col-sm-15">
        <div class="card-body">	
            <!-- //header-ends -->
            <!-- main content start-->
            <div id="page-wrapper">
                <div class="main-page">
                    <div class="sign-up-row widget-shadow">
                        <div class="form-title">
                            <h4>New zone :</h4>
                        </div>
                        
                        <div class="custom-box" style="margin-bottom: 50px; margin-left: 20px; border-left: 5px solid #007bff; padding-top: 15px;">
                            <h5><i class="icon fas fa-info"></i> You need to set your domain nameservers to:</h5>
                            <ul class="gray-background">
                                <li>ns1.centos-webpanel.com</li>
                                <li>ns2.centos-webpanel.com</li>
                                <li>ns3.centos-webpanel.com</li>
                                <li>ns4.centos-webpanel.com</li>
                                <li>ns5.centos-webpanel.com</li>
                            </ul>
                        </div>

                        <!-- Displaying validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Zone form starts here -->
                        <form action="{{ route('zones.store') }}" method="POST">
                            @csrf
                            
                            <div class="form-group row" style="margin-top: 2em;">
                                <label for="name" class="col-sm-2 control-label">Zone/Domain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Domain/Zone Name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="refresh" class="col-sm-2 control-label">Refresh</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('refresh', '28800') }}" id="refresh" name="refresh" placeholder="Refresh">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="retry" class="col-sm-2 control-label">Retry</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('retry', '7200') }}" id="retry" name="retry" placeholder="Retry">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expire" class="col-sm-2 control-label">Expire</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('expire', '1209600') }}" id="expire" name="expire" placeholder="Expire">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ttl" class="col-sm-2 control-label">Time To Live</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('ttl', '86400') }}" id="ttl" name="ttl" placeholder="Time To Live">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pri_dns" class="col-sm-2 control-label">Primary NS</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('pri_dns', 'ns1.centos-webpanel.com') }}" id="pri_dns" name="pri_dns" placeholder="Primary NS">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sec_dns" class="col-sm-2 control-label">Secondary NS</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('sec_dns', 'ns2.centos-webpanel.com') }}" id="sec_dns" name="sec_dns" placeholder="Secondary NS">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="www" class="col-sm-2 control-label">Web Server IP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('www') }}" id="www" name="www" placeholder="Web Server IP">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mail" class="col-sm-2 control-label">Mail Server IP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('mail') }}" id="mail" name="mail" placeholder="Mail Server IP">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ftp" class="col-sm-2 control-label">FTP Server IP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ old('ftp') }}" id="ftp" name="ftp" placeholder="FTP Server IP">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Add Zone
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="css/select2/select2.min.css" rel="stylesheet">
<script src="js/select2/select2.min.js"></script>
<script>
$(document).ready(function(){
    $("#owner").select2({
        minimumInputLength: 2,
        ajax: {
            url: 'ajax/usersSelect.php',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term // search term
                };
            },
            processResults: function (data, page) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.username,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#owner').on('select2:select', function (e) {
       $("#ownderSelec").val(e.params.data.id);
    });
});
</script>

<style>
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 18px;
}
.select2-container--default .select2-selection--single{
    border: 1px solid #ced4da;
}
.select2-container .select2-selection--single{
    height: 32px;
    line-height: 18px;
}
</style>

@endsection