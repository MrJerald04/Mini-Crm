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
              <h1 class="m-0 text-dark">Employee Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin/employees">Employee</a></li>
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
                   
                        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-delete-employee" style="margin-left:5px;"><i class="fas fa-trash"></i></button>
                        <a class='btn btn-warning float-right' href='/export/{{$employee->id}}' style="margin-left:5px;"><i class='nav-icon fas fa-download'></i></a>
                        <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#modal-edit-employee"><i class="fas fa-edit"></i></button>
              
                    
                    
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
                                    <h5 class="text-primary"><a href="/admin/companies/{{$employee->company_id}}">{{$company->name}}</a></h5>
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
                                <h5 class="text-success">{{$country->name}}</h5>
                            </div>
                        </div>
                    
                    <br>
                </div>
            </div>
         
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
<div class="modal fade" id="modal-edit-employee">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-warning">Update Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['action' => ['Admin\EmployeeController@update', $employee->id], 'method' => 'POST']) !!}
        <div class="modal-body">  
            <div class="form-group">
                {{Form::label('lastname', 'Lastname')}}
                {{Form::text('lastname', $employee->last_name, ['class' => 'form-control', 'placeholder' => 'Lastname'])}}
            </div>
            <div class="form-group">
                {{Form::label('firstname', 'Firstname')}}
                {{Form::text('firstname', $employee->first_name, ['class' => 'form-control', 'placeholder' => 'Firstname'])}}
            </div>
            {{-- combobox here for company --}}
            <div class="form-group">
                {!! Form::Label('company', 'Company:') !!}
                <select class="form-control" name="company">
                   
                   
                    @foreach($companiesList as $companyList)
                        @if ($companyList->id == $employee->company_id)
                            <option value="{{$companyList->id}}" selected>{{$companyList->name}}</option>
                        @else
                            <option value="{{$companyList->id}}">{{$companyList->name}}</option>
                        @endif
                        
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', $employee->email, ['class' => 'form-control', 'placeholder' => 'Example@gmail.com'])}}
            </div>
            <div class="form-group">
                {{Form::label('phone', 'Phone')}}
                {{Form::text('phone', $employee->phone, ['class' => 'form-control only-numeric', 'placeholder' => '09xxxxxxxxx'])}}
                <span class="error" style="color: red; display: none">* Input digits (0 - 9)</span>
            </div> 
            <div class="form-group">
                {!! Form::Label('country', 'Country') !!}
                <select class="form-control" name="country">
                    @foreach($countriesList as $countryList)
                        @if ($countryList->id == $employee->country_id)
                            <option value="{{$countryList->id}}" selected>{{$countryList->name}}</option>
                        @else
                            <option value="{{$countryList->id}}">{{$countryList->name}}</option>
                        @endif
                        
                    @endforeach
                </select>
            </div> 
        </div>
        <div class="modal-footer justify-content-right">
            {{Form::hidden('_method','PUT')}}
            {{Form::button('<i class="fas fa-save"></i>&nbsp; Update', ['type' => 'submit', 'class' => 'btn btn-primary btn-md float-right'] )  }}
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp; Close</button>
        </div>
        {!! Form::close() !!}
        
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-delete-employee">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger">Delete Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure to delete this employee, <strong>{{$employee->first_name}}</strong></p>
        </div>
        <div class="modal-footer justify-content-rigth">
            {!! Form::open(['action' => ['Admin\EmployeeController@destroy', $employee->id], 'method' => 'POST']) !!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::button('<i class="fas fa-check"></i>&nbsp; Yes', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp; No</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
