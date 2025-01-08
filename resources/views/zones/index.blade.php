@extends('layouts.app')

@section('content')

<div class="col-sm-15">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('zones.index') }}">Main</a>
        </li>
        <li class="breadcrumb-item">Zones</li>
    </ol>
</div>

<h1>Zones</h1>

<div class="custom-box" style="margin-bottom: 50px; margin-top: 20px; border-top: 5px solid #007bff; padding-top: 15px;width">
    <div class="col-sm-15">
        <div class="row">
            <div class="col-md-12 text-right">
                <a class="btn btn-primary btn-flat" href="{{ route('zones.create') }}">
                    <i class="fa fa-plus-circle"></i> Create a new zone
                </a>
            </div>
        </div>
    </div>
    <div class="custom-box" style="margin-bottom: 50px; margin-left: 10px; border-left: 5px solid #007bff; padding-top: 5px;">
        <h5><i class="icon fas fa-info"></i> You need to set your domain nameservers to:</h5>
        
        <ul class="gray-background">
            <li>ns1.centos-webpanel.com</li>
            <li>ns2.centos-webpanel.com</li>
            <li>ns3.centos-webpanel.com</li>
            <li>ns4.centos-webpanel.com</li>
            <li>ns5.centos-webpanel.com</li>
        </ul>
    </div>
    <div class="form-group">
        <div class="d-flex justify-content-between align-items-center">
            <!-- "Show entries" Section -->
            <div>
                <label>Show
                    <select name="table_zone_length" aria-controls="table_zone" class="custom-select custom-select-sm form-control form-control-sm d-inline-block"style="width: 70px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    entries
                </label>
            </div>
            <!-- "Search" Section -->
            <div>
                <label>Search:
                    <input type="search" id="searchInput" class="form-control form-control-sm d-inline-block w-auto" placeholder="" aria-controls="table_zone">
                </label>
            </div>
        </div>
    </div>
    
    
    
        <table class="table"id="dataTable">
            <thead>
                <tr class="text-white bg-primary">
                    <th>Name</th>
                    <th>Serial</th>
                    <th>User </span></th>
                    <th>Changed</th>
                    <th>Valid </th>
                    <th>Delete</th>
                </tr>
            </thead>
            
                </thead>
                <tbody>
                    @foreach($zones as $index => $zone)
                    <tr style="background-color: {{ $index % 2 == 0 ? '#f2f2f2' : '#ffffff' }};">
                        <td>
                            <a href="{{ route('zones.editzone', ['id' => $zone->id]) }}">
                                <span style="background-color: rgb(0, 132, 255); color: white; padding: 2px 4px; border-radius: 3px;">
                                    {{ $zone->name }}
                                </span>
                            </a>
                        </td>
                        <td>{{ $zone->id }}</td>
                        <td>{{ $zone->user->username ?? 'N/A' }}</td> <!-- ज़ोन के मालिक का नाम -->
                        <td>
                            <span class="right badge badge-success"><i class="fa fa-check-circle"></i></span>
                        </td>
                        <td>
                            <span class="right badge badge-secondary"><i class="fa fa-times"></i></span>
                        </td>
                        <td>
                            <!-- The form for deleting a zone -->
                            <form action="{{ route('zones.destroy', $zone->id) }}" method="POST" id="deleteForm-{{ $zone->id }}">
                                @csrf
                                @method('DELETE')
                                <!-- Button triggers SweetAlert2 confirmation dialog -->
                                <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete({{ $zone->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
            <script>
                document.getElementById('searchInput').addEventListener('keyup', function () {
                    const filter = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#dataTable tbody tr');
                    
                    rows.forEach(row => {
                        const text = row.innerText.toLowerCase();
                        row.style.display = text.includes(filter) ? '' : 'none';
                    });
                });
            </script>
            
            <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="table_zone_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="table_zone_previous"><a href="#" aria-controls="table_zone" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="table_zone" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="table_zone_next"><a href="#" aria-controls="table_zone" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div>
    </div>
</div>
@endsection