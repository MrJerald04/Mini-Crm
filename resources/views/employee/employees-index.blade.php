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
              <h1 class="m-0 text-dark">Employees</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                      <h2 class="card-title">Employees Table</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="employee-table" class="table table-striped table-hover table-bordered table-responsive-md">
                            <thead class="thead-light">
                            <tr>
                                <th>Employee Name</th>
                                <th>Email</th>
                                <th>Action</th>
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
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
  <!-- /.content -->
@endsection