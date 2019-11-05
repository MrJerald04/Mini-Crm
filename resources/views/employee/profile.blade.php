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
          <h1 class="m-0 text-dark">Profile</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" value="{{$user->last_name}}" class="form-control" placeholder="Enter ..." disabled>
                          </div>
                          <div class="form-group">
                              <label>First Name</label>
                              <input type="text" value="{{$user->first_name}}" class="form-control" placeholder="Enter ..." disabled>
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <input type="text" value="{{$user->email}}" class="form-control" placeholder="Enter ..." disabled>
                          </div>
                          
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Company</label>
                              <input type="text" value="{{$employee_company_name->name}}" class="form-control" placeholder="Enter ..." disabled>
                          </div>
                          <div class="form-group">
                              <label>Phone</label>
                              <input type="text" value="{{$user->phone}}" class="form-control" placeholder="Enter ..." disabled>
                          </div>
                          <div class="form-group">
                              <label>Country</label>
                              <input type="text" value="{{$country->name}}" class="form-control" placeholder="Enter ..." disabled>
                          </div>
                          
                        </div>
                      </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-change-password"><i class="fas fa-cog"></i>&nbsp; Change Password</button>
                </div>
                </div>
                <!-- /.card -->
    
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
         {{-- input some forms here --}}
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection
<div class="modal fade" id="modal-change-password">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['Employee\ChangePasswordController@update', $user->id], 'method' => 'POST']) !!}
      <div class="modal-body">
          <div class="form-group">
              {{Form::label('oldpassword', 'Old Password')}}
              {{Form::password('oldpassword', ['class' => 'form-control', 'placeholder' => 'old password...'])}}
          </div>
          <div class="form-group">
              {{Form::label('newpassword', 'New Password')}}
              {{Form::password('newpassword', ['class' => 'form-control', 'placeholder' => 'new password...'])}}
          </div>
          <div class="form-group">
              {{Form::label('confirmpassword', 'Confirm Password')}}
              {{Form::password('confirmpassword', ['class' => 'form-control', 'placeholder' => 'confirm password...'])}}
          </div>
      </div>
      <div class="modal-footer justify-content-right">
          {{Form::hidden('_method','PUT')}}
          {{Form::button('<i class="fas fa-save"></i>&nbsp; Continue', ['type' => 'submit', 'class' => 'btn btn-primary btn-md float-right'] )  }}
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp; Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->