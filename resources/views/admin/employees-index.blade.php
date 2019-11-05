@extends('layouts.master')
@section('header')
  @include('inc.admin.header')
@endsection
@section('sidebar')
  @include('inc.admin.sidebar')
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
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-add-employee">
                            <i class="fas fa-user"></i>&nbsp; Add Employee
                        </button>
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
  <div class="modal fade" id="modal-add-employee">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-primary">Add Employee</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['action' => 'Admin\EmployeeController@store', 'method' => 'POST']) !!}
        <div class="modal-body">       
            <div class="form-group">
                {{Form::label('lastname', 'Lastname')}}<i class="text-danger text-lg"> *</i>
                {{Form::text('lastname', '', ['class' => 'form-control', 'placeholder' => 'Lastname'])}}
            </div>
            <div class="form-group">
                {{Form::label('firstname', 'Firstname')}}<i class="text-danger text-lg"> *</i>
                {{Form::text('firstname', '', ['class' => 'form-control', 'placeholder' => 'Firstname'])}}
            </div>
            {{-- combobox here for company --}}
            <div class="form-group">
                {!! Form::Label('company', 'Company:') !!}
                <select class="form-control" name="company">
                    @foreach($companies as $company)
                      <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Example@gmail.com'])}}
            </div>
            <div class="form-group">
                {{Form::label('phone', 'Phone')}}
                {{Form::text('phone', '', ['class' => 'form-control only-numeric', 'placeholder' => '09xxxxxxxxx'])}}
                <span class="error" style="color: red; display: none">* Input digits (0 - 9)</span>
            </div>   
            <div class="form-group">
                {!! Form::Label('country', 'Country') !!}
                <select class="form-control" name="country">
                    @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer justify-content-right">
          {{Form::button('<i class="fas fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success btn-md float-right'] )  }}
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        </div>
        {!! Form::close() !!}
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection