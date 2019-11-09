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
              <h1 class="m-0 text-dark">Employee Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/employee/employees">Employee</a></li>
                <li class="breadcrumb-item active">Employee Information</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
                
            <div class="card">
                    
                <div class="card-body mx-auto" style="width:50%;">
                    <br>
                    <h4 class="m-0 text-dark text-left">{{$employee->first_name}} {{$employee->last_name}}</h4>
                    <p class="text-primary" style="margin-top:10px;"><i class="fas fa-envelope"></i>&nbsp; {{$employee->email}}</p>
                    <br>
                    <h5>About</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <strong><i class="fas fa-building"></i>&nbsp; Company</strong><br>
                        </div>
                        <div class="col-md-6">
                            @if ($company_null == 'NO')
                                <a href="/employee/companies/{{$employee->company_id}}"><h5 class="text-primary">{{$company->name}}</h5></a>
                            @else
                                <h5 class="text-muted">No Company</h5>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <strong><i class="fas fa-mobile"></i>&nbsp; Phone</strong><br>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-warning">{{$employee->phone}}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-globe"></i>&nbsp; Country</strong><br>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-success">{{session('country')}}</h5>
                            </div>
                        </div>
                    
                    <br>
                </div>
            </div>
         
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
@endsection
