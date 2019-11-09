@extends('layouts.employee-master')
@section('header')
  @include('inc.employee.header')
@endsection
@section('sidebar')
  @include('inc.employee.sidebar')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Company Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/employee/companies">Companies</a></li>
                <li class="breadcrumb-item active">Company Information</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
                <!-- About Me Box -->
                <div class="card">
                    <div class="card-body">
                        <br><br>  
                        <img style="width:150px" class="img-circle img-bordered-sm mx-auto d-block" src="/storage/logo/{{$company->logo}}" alt="company logo"><br>
                        <h4 class="text-center text-xlg">
                                {{$company->name}}
                        </h4>
                        <br><br>
                        <hr>
                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">{{$company->email}}</p>
                        <hr>
                            <strong><i class="fas fa-link mr-1"></i> Website</strong>
                            <p class="text-muted">{{$company->website}}</p>
                        <hr>
                        
                            <strong><i class="fas fa-globe mr-1"></i> Country</strong>
                            <p class="text-muted">{{$countries}}</p>
                            <hr>
                            <strong><i class="fas fa-map mr-1"></i> Color in Map</strong>
                            <p class="p-3 mb-2 bg" style="background-color:{{$company->color}};"></p>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-8">
                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Employees in {{$company->name}}</h3>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="company-employee-table" class="table table-striped table-hover table-bordered table-responsive-md">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
@endsection

@section('script')
    @php
        $cid = $company->id;
    @endphp
    <script>
        $(function(){
            //datatable pagination for company employees, sort, search, filter (server side)
            $('#company-employee-table').DataTable({
            "autoWidth": false,
                processing: true,
                serverSide: true,
                columnDefs: [
                    { width: '80%', targets: 0 },
                    { width: '20%', targets: 1 }
                ],
                ajax: '{!! route('company_employee.data',['cid' => $company->id]) !!}',
                columns: [
                    { data: 'last_name',
                    render: function ( data, type, row ) {
                        return row.last_name + ', ' + row.first_name;
                    } 
                    },
                    {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, full, meta){
                        
                        data = "<a class='btn btn-primary' style='margin-right:5px;' href='/employee/employees/"+data+"'><i class='nav-icon fas fa-eye'></i></a>";
                        return data;
                    },
                    orderable: false
                    }
                
                ]
            });// end datatable
        });
    </script>
@endsection