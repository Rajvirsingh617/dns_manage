@extends('layouts.app')

@section('content')

<div class="col-sm-15">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('zones.index') }}">Main</a>
        </li>
        <li class="breadcrumb-item">Viewing zone</li>
    </ol>
    <h1>Viewing zone</h1>
</div>
<div class="custom-box"
    style="margin-bottom: 50px; margin-top: 20px; border-top: 5px solid #007bff; padding-top: 15px;">
    <div class="card-body">
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="sign-up-row widget-shadow">
                    <p>Here you can modify your zone's SOA record, or add, edit, or delete resource records</p>
                    <div class="row">
                        <div class="col-md-12 text-right"><a class="btn btn-danger btn-xs" style="color:#fff"
                                onclick="deletezone('86527')"><i class="fa fa-trash"></i> Delete Zone</a></div>
                        <div class="well col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3>Dns Zone Test</h3>
                                </div>

                            </div>
                            <pre style="background: #e9ecef;border-radius:10px">{{ $zone->name }} /IN: loaded serial {{ $zone->id }} OK</pre>
                        </div>
                        <div class="col-md-6">
                            <h3>Real Domain nameservers</h3>
                            <div style="text-align:left;padding:15px;background: #e9ecef;border-radius:10px;font-family: SFMono-Regular,Menlo,Monaco,Consolas,"
                                liberation="" mono','courier="" new',monospace;font-size:="" 1em;"="">
                                ns1.digimedia.com<br> ns2.digimedia.com<br> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <form name="form1" method="POST" action="{{ route('zones.update', $zone->id) }}">
                                @csrf
                                @method('PUT') <!-- Specify the method as PUT for the update operation -->
                                <input type="hidden" name="zoneid" id="zoneid" value="{{ $zone->id }}">
                                
                                <div class="form-title">

                                </div>
                                <div class="form-title">
                                    <h4>Viewing zone</h4>
                                </div>
                                <div class="custom-box" style="margin-bottom:50px;margin-top:20px;border-left: 5px solid #007bff; width: 60%; margin-left: 20%;">
                                <div class="row" style="padding-left: 30%">
                                    <div class="callout callout-info col-md-8">
                                        <h5><i class="icon fas fa-success"></i> You need to set your domain nameservers
                                            to:</h5>
                                        <div align="left">
                                            <span style="font-size: 14px"
                                                class="badge bg-secondary">ns1.centos-webpanel.com </span><br>
                                            <span style="font-size: 14px"
                                                class="badge bg-secondary">ns2.centos-webpanel.com </span> &nbsp;<br>
                                            <span style="font-size: 14px"
                                                class="badge bg-secondary">ns3.centos-webpanel.com </span> <br>
                                            <span style="font-size: 14px"
                                                class="badge bg-secondary">ns4.centos-webpanel.com </span> <br>
                                            <span style="font-size: 14px"
                                                class="badge bg-secondary">ns5.centos-webpanel.com </span> &nbsp;<br>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 2em;">
                                    <label for="name" class="col-sm-2 control-label"><strong>Zone/Domain</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $zone->name }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="focusedinput" class="col-sm-2 control-label"><strong>Refresh</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="refresh" name="refresh"
                                            value="{{ $zone->refresh }}" placeholder="Refresh">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="focusedinput" class="col-sm-2 control-label"><strong>Retry</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="retry" name="retry"
                                            value="{{ $zone->retry }}" placeholder="Retry">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="focusedinput" class="col-sm-2 control-label"><strong>Expire</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="expire" name="expire"
                                            value="{{ $zone->expire }}" placeholder="Expire">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="focusedinput" class="col-sm-2 control-label"><strong>Time To Live</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ttl" name="ttl"
                                            value="{{ $zone->ttl }}" placeholder="Time To Live">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="focusedinput" class="col-sm-2 control-label"><strong>Primary NS</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pri_dns" name="pri_dns"
                                            value="{{ $zone->pri_dns }}" placeholder="Primary NS">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="focusedinput" class="col-sm-2 control-label"><strong>Secondary NS</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="sec_dns" name="sec_dns"
                                            value="{{ $zone->sec_dns }}" placeholder="Secondary NS">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="owner" class="col-sm-2 control-label"><strong>Owner</strong></label>
                                    <div class="col-sm-8">
                                        <select name="owner" id="owner" class="form-control select2">
                                            <option value="{{ $zone->user->id }}" selected>
                                                {{ $zone->user->username }}</option>
                                        </select>
                                    </div>
                                </div>


                                <div style="text-align: center">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Edit
                                        zone</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 2em;">

                        <div class="col-sm-12">

                            <table class="table table-stiped">
                                <thead>
                                    <tr class="bg-lightblue">
                                        <th>Host</th>
                                        <th>Type</th>
                                        <th>Destination</th>
                                        <th>Valid</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <td>
                                            <input type="text" name="host[0]" class=" form-control" value="@" size="16">
                                            <input type="hidden" name="host_id[0]" value="351949">
                                        </td>
                                        <td>
                                            <select name="type[0]" class=" form-control">
                                                <option selected="" value="A">A</option>
                                                <option value="A6">A6</option>
                                                <option value="AAAA">AAAA</option>
                                                <option value="AFSDB">AFSDB</option>
                                                <option value="CNAME">CNAME</option>
                                                <option value="DNAME">DNAME</option>
                                                <option value="DS">DS</option>
                                                <option value="LOC">LOC</option>
                                                <option value="MX">MX</option>
                                                <option value="NAPTR">NAPTR</option>
                                                <option value="NS">NS</option>
                                                <option value="PTR">PTR</option>
                                                <option value="RP">RP</option>
                                                <option value="SRV">SRV</option>
                                                <option value="SSHFP">SSHFP</option>
                                                <option value="TXT">TXT</option>
                                                <option value="WKS">WKS</option>
                                                <option value=""></option>

                                            </select>
                                        </td>
                                        <td>


                                            <input type="text" name="destination[0]" class=" form-control" size="26"
                                                value="{{ $zone->www }}">


                                        </td>
                                        <td>

                                            <span class="right badge badge-success" style="padding: 3px"><i
                                                    class="fa fa-check-circle"></i></span>

                                        </td>
                                        <td>
                                            <center><input type="checkbox" name="delete[0]" class=""></center>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <input type="text" name="host[1]" class=" form-control" value="@" size="16">
                                            <input type="hidden" name="host_id[1]" value="351952">
                                        </td>
                                        <td>
                                            <select name="type[1]" class=" form-control">
                                                <option value="A">A</option>
                                                <option value="A6">A6</option>
                                                <option value="AAAA">AAAA</option>
                                                <option value="AFSDB">AFSDB</option>
                                                <option value="CNAME">CNAME</option>
                                                <option value="DNAME">DNAME</option>
                                                <option value="DS">DS</option>
                                                <option value="LOC">LOC</option>
                                                <option selected="" value="MX">MX</option>
                                                <option value="NAPTR">NAPTR</option>
                                                <option value="NS">NS</option>
                                                <option value="PTR">PTR</option>
                                                <option value="RP">RP</option>
                                                <option value="SRV">SRV</option>
                                                <option value="SSHFP">SSHFP</option>
                                                <option value="TXT">TXT</option>
                                                <option value="WKS">WKS</option>
                                                <option value=""></option>

                                            </select>
                                        </td>
                                        <td>


                                            <input type="text" name="pri[1]" class=" form-control" size="1" value="10">

                                            <input type="text" name="destination[1]" class=" form-control" size="26"
                                                value="{{ $zone->name }}">


                                        </td>
                                        <td>

                                            <span class="right badge badge-success" style="padding: 3px"><i
                                                    class="fa fa-check-circle"></i></span>

                                        </td>
                                        <td>
                                            <center><input type="checkbox" name="delete[1]" class=""></center>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <input type="text" name="host[2]" class=" form-control" value="ftp"
                                                size="16">
                                            <input type="hidden" name="host_id[2]" value="351953">
                                        </td>
                                        <td>
                                            <select name="type[2]" class=" form-control">
                                                <option selected="" value="A">A</option>
                                                <option value="A6">A6</option>
                                                <option value="AAAA">AAAA</option>
                                                <option value="AFSDB">AFSDB</option>
                                                <option value="CNAME">CNAME</option>
                                                <option value="DNAME">DNAME</option>
                                                <option value="DS">DS</option>
                                                <option value="LOC">LOC</option>
                                                <option value="MX">MX</option>
                                                <option value="NAPTR">NAPTR</option>
                                                <option value="NS">NS</option>
                                                <option value="PTR">PTR</option>
                                                <option value="RP">RP</option>
                                                <option value="SRV">SRV</option>
                                                <option value="SSHFP">SSHFP</option>
                                                <option value="TXT">TXT</option>
                                                <option value="WKS">WKS</option>
                                                <option value=""></option>

                                            </select>
                                        </td>
                                        <td>


                                            <input type="text" name="destination[2]" class=" form-control" size="26"
                                                value="{{ $zone->ftp }}">


                                        </td>
                                        <td>

                                            <span class="right badge badge-success" style="padding: 3px"><i
                                                    class="fa fa-check-circle"></i></span>

                                        </td>
                                        <td>
                                            <center><input type="checkbox" name="delete[2]" class=""></center>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <input type="text" name="host[3]" class=" form-control" value="mail"
                                                size="16">
                                            <input type="hidden" name="host_id[3]" value="351951">
                                        </td>
                                        <td>
                                            <select name="type[3]" class=" form-control">
                                                <option selected="" value="A">A</option>
                                                <option value="A6">A6</option>
                                                <option value="AAAA">AAAA</option>
                                                <option value="AFSDB">AFSDB</option>
                                                <option value="CNAME">CNAME</option>
                                                <option value="DNAME">DNAME</option>
                                                <option value="DS">DS</option>
                                                <option value="LOC">LOC</option>
                                                <option value="MX">MX</option>
                                                <option value="NAPTR">NAPTR</option>
                                                <option value="NS">NS</option>
                                                <option value="PTR">PTR</option>
                                                <option value="RP">RP</option>
                                                <option value="SRV">SRV</option>
                                                <option value="SSHFP">SSHFP</option>
                                                <option value="TXT">TXT</option>
                                                <option value="WKS">WKS</option>
                                                <option value=""></option>

                                            </select>
                                        </td>
                                        <td>


                                            <input type="text" name="destination[3]" class=" form-control" size="26"
                                                value="{{ $zone->mail }}">


                                        </td>
                                        <td>

                                            <span class="right badge badge-success" style="padding: 3px"><i
                                                    class="fa fa-check-circle"></i></span>

                                        </td>
                                        <td>
                                            <center><input type="checkbox" name="delete[3]" class=""></center>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <input type="text" name="host[4]" class=" form-control" value="www"
                                                size="16">
                                            <input type="hidden" name="host_id[4]" value="351950">
                                        </td>
                                        <td>
                                            <select name="type[4]" class=" form-control">
                                                <option value="A">A</option>
                                                <option value="A6">A6</option>
                                                <option value="AAAA">AAAA</option>
                                                <option value="AFSDB">AFSDB</option>
                                                <option selected="" value="CNAME">CNAME</option>
                                                <option value="DNAME">DNAME</option>
                                                <option value="DS">DS</option>
                                                <option value="LOC">LOC</option>
                                                <option value="MX">MX</option>
                                                <option value="NAPTR">NAPTR</option>
                                                <option value="NS">NS</option>
                                                <option value="PTR">PTR</option>
                                                <option value="RP">RP</option>
                                                <option value="SRV">SRV</option>
                                                <option value="SSHFP">SSHFP</option>
                                                <option value="TXT">TXT</option>
                                                <option value="WKS">WKS</option>
                                                <option value=""></option>

                                            </select>
                                        </td>
                                        <td>


                                            <input type="text" name="destination[4]" class=" form-control" size="26"
                                                value="@">


                                        </td>
                                        <td>

                                            <span class="right badge badge-success" style="padding: 3px"><i
                                                    class="fa fa-check-circle"></i></span>

                                        </td>
                                        <td>
                                            <center><input type="checkbox" name="delete[4]" class=""></center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr>

                            <h3>New Record</h3>

                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <tr class="bg-lightblue">
                                        <th>Host</th>
                                        <th>Type</th>
                                        <th>Destination</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>
                                            <input type="text" name="newhost" class="form-control" size="16">
                                        </td>
                                        <td>
                                            <select name="nertype" class="form-control">
                                                <option value="A">A</option>
                                                <option value="A6">A6</option>
                                                <option value="AAAA">AAAA</option>
                                                <option value="AFSDB">AFSDB</option>
                                                <option value="CNAME">CNAME</option>
                                                <option value="DNAME">DNAME</option>
                                                <option value="DS">DS</option>
                                                <option value="LOC">LOC</option>
                                                <option value="MX">MX</option>
                                                <option value="NAPTR">NAPTR</option>
                                                <option value="NS">NS</option>
                                                <option value="PTR">PTR</option>
                                                <option value="RP">RP</option>
                                                <option value="SRV">SRV</option>
                                                <option value="SSHFP">SSHFP</option>
                                                <option value="TXT">TXT</option>
                                                <option value="WKS">WKS</option>
                                                <option value=""></option>

                                            </select>

                                        </td>
                                        <td><input type="text" name="newdestination" class="form-control" size="32">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <input type="hidden" name="total" value="5">
                            <div style="text-align: center">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
