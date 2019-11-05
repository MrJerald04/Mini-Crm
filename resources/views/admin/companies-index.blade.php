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
          <h1 class="m-0 text-dark">Companies</h1>
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
                <h3 class="card-title">Companies Table</h3>
                  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-add-company">
                      <i class="fas fa-building"></i>&nbsp; Add Company
                  </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <br>
                <table id="company-table" class="table table-striped table-hover table-bordered table-responsive-md">
                  <thead class="thead-light">
                  <tr>
                    <th>Company Name</th>
                    <th>Website</th>
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
  <div class="modal fade" id="modal-add-company">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-info">Add Company</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['action' => 'Admin\CompanyController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-body">   
            <img style="width:150px" id="logo-img-tag" class="img-circle img-bordered-sm mx-auto d-block" src="/storage/logo/noimage.png" alt="company logo"><br>    
            <div class="form-group">
                {{Form::label('name', 'Name')}}<i class="text-danger text-lg"> *</i>
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Example@gmail.com'])}}
            </div>
            <div class="form-group">
                {{Form::label('website', 'Website')}}
                {{Form::text('website', '', ['class' => 'form-control', 'placeholder' => 'Website'])}}
            </div>
            <div class="form-group">
                {!! Form::Label('country', 'Country') !!}
                <select class="form-control" name="country">
                    @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Color Picker -->
            <div class="form-group">
              <label>Choose Color</label>
              {{Form::label('color', 'Color')}}
              <div class="input-group my-colorpicker2">
                {{Form::text('color', '', ['class' => 'form-control'])}}

                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group">
                {{Form::label('textLogo', 'Logo')}}
                {{Form::file('logo',['class' => 'form-control', 'id' => 'logo-img'])}}
                <small class="text-muted">
                  {{Form::label('website', 'minimum dimension 100×100 and no more than 2mb in size')}}
                </small>
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