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
          <h1 class="m-0 text-dark">Send Email</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          
          <!-- About Me Box -->
          <div class="card">
            {!! Form::open(['action' => 'Admin\SendEmailController@store', 'method' => 'POST']) !!}
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4">
                          {{Form::label('from_name', 'From Name')}}
                          {{Form::text('from_name', '', ['class' => 'form-control', 'placeholder' => 'From Name..'])}}
                      </div>
                      <div class="col-sm-8">
                          {{Form::label('from_email', 'Email')}} <span class="text-muted text-sm">(required)</span>
                          {{Form::email('from_email', '', ['class' => 'form-control', 'placeholder' => 'from email..'])}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4">
                          {{Form::label('to_name', 'To Name')}}
                          {{Form::text('to_name', '', ['class' => 'form-control', 'placeholder' => 'To Name..'])}}
                      </div>
                      <div class="col-sm-8">
                          {{Form::label('to_email', 'Email')}}<span class="text-muted text-sm">(required)</span>
                          {{Form::email('to_email', '', ['class' => 'form-control', 'placeholder' => 'to email..'])}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('message', 'Message')}}
                    {{Form::textarea('message', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Type you message here..'])}}
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="custom-control custom-radio">
                        {{Form::radio('send_status', 'now', true, ['class' => 'custom-control-input', 'id' => 'customRadio1', 'name' => 'send_status'])}}
                        <label for="customRadio1" class="custom-control-label">Send Now</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="custom-control custom-radio">
                        {{Form::radio('send_status', 'later', false, ['class' => 'custom-control-input', 'id' => 'customRadio2', 'name' => 'send_status'])}}
                        <label for="customRadio2" class="custom-control-label">Send Later</label>
                      </div>
                    </div>
                  </div>
                    
                    
                </div>
                <hr>


                <!-- time Picker -->
                <div class="bootstrap-timepicker" id="date_input">
                  <div class="form-group">
                    <label>Select date to send:</label>

                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                      {{-- <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"/> --}}
                      {{Form::text('date_to_send', '', ['class' => 'form-control datetimepicker-input', 'data-target' => '#timepicker', 'placeholder' => 'Select date & time'])}}
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-calendar"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                
            </div>
            <div class="card-footer">
                {{Form::button('<i class="fas fa-paper-plane"></i> Send', ['type' => 'submit', 'class' => 'btn btn-success btn-md float-right'] )  }}
            </div>
            {!! Form::close() !!}
            
            
          </div>
    
        </div>
        
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection