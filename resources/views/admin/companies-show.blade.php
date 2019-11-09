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
              <h1 class="m-0 text-dark">Company Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin/companies">Companies</a></li>
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
                 
                        <div class="card-footer">
                            
                            @if ($checkCompanyResult)
                                <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-warning-delete-company">
                                    <i class="fas fa-trash"></i>&nbsp; Delete
                                </button>
                            @else
                                <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-delete-company">
                                    <i class="fas fa-trash"></i>&nbsp; Delete
                                </button>
                            @endif
                            <button type="button" class="btn btn-warning float-right" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-edit-company">
                                <i class="fas fa-edit"></i>&nbsp; Edit
                            </button>
                        </div>
                    
                    
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
                                    <div class="col-md-6">
                                        <div class="form-group float-right">
                                            <div class="input-group">
                                                <button type="button" class="btn btn-primary" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-import-employee">
                                                    <i class="fas fa-download"></i>&nbsp; Import
                                                </button>                                               
                                            </div>
                                        </div>
                                        
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
<div class="modal fade" id="modal-edit-company">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-warning">Update Company</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['action' => ['Admin\CompanyController@update', $company->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-body">  
            <img style="width:150px" id="logo-img-tag" class="img-circle img-bordered-sm mx-auto d-block" src="/storage/logo/{{$company->logo}}" alt="company logo"><br>     
            <div class="form-group">
                {{Form::label('name', 'Name')}}<i class="text-danger text-lg"> *</i>
                {{Form::text('name', $company->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', $company->email, ['class' => 'form-control', 'placeholder' => 'Example@gmail.com'])}}
            </div>
            <div class="form-group">
                {{Form::label('website', 'Website')}}
                {{Form::text('website', $company->website, ['class' => 'form-control', 'placeholder' => 'Website'])}}
            </div>
            <div class="form-group">
                {!! Form::Label('country', 'Country') !!}
                <select class="form-control" name="country">
                    @foreach($countryList as $countriesList)
                        @if ($countriesList->id == $country_id)
                            <option value="{{$countriesList->id}}" selected>{{$countriesList->name}}</option>
                        @else
                            <option value="{{$countriesList->id}}">{{$countriesList->name}}</option>
                        @endif
                        
                    @endforeach
                </select>
            </div>
            <!-- Color Picker -->
            <div class="form-group">
                <label>Choose Color</label>
                {{Form::label('color', 'Color')}}
                <div class="input-group my-colorpicker2">
                {{Form::text('color', $company->color, ['class' => 'form-control'])}}

                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                {{Form::label('textLogo', 'Logo')}}
                {{Form::file('logo',['class' => 'form-control', 'id' => 'logo-img'])}}
                <small class="text-muted">
                    {{Form::label('website', 'minimum dimension 100×100 and no more than 2mb in size')}}
                </small>
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
    <div class="modal fade" id="modal-delete-company">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-danger"><i class="fas fa-trash"></i>&nbsp; Delete Company</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this company, <strong>{{$company->name}}</strong></p>
            </div>
            <div class="modal-footer justify-content-rigth">
                {!! Form::open(['action' => ['Admin\CompanyController@destroy', $company->id], 'method' => 'POST']) !!}
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
    <!-- /.modal -->
    <div class="modal fade" id="modal-warning-delete-company">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-warning"><i class="fas fa-exclamation-triangle"></i>&nbsp; Warning</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>If you delete this company, All employee under <strong>{{$company->name}}</strong> also will be deleted. Are you sure to delete?</p>
                </div>
                <div class="modal-footer justify-content-rigth">
                    {!! Form::open(['action' => ['Admin\CompanyController@destroyCompanyAndEmployee', $company->id], 'method' => 'POST']) !!}
                      
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
    <!-- /.modal -->
    <div class="modal fade" id="modal-import-employee">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-secondary"><i class="fas fa-info"></i>&nbsp; Import Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!! Form::open(['action' => ['Admin\CompanyController@import', $company->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="customFile">Choose File</label>
                                <div class="custom-file">
                                    {{Form::file('file', ['class' => 'custom-file-input', 'id' => 'customFile'])}}
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>   
                        </div>
                        <div class="modal-footer justify-content-rigth">
                            
                            {{Form::button('<i class="fas fa-check"></i>&nbsp; Continue', ['type' => 'submit', 'class' => 'btn btn-primary float-right'] )  }}
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp; Cancel</button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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
                        
                        data = "<a class='btn btn-primary' style='margin-right:5px;' href='/admin/employees/"+data+"'><i class='nav-icon fas fa-eye'></i></a>";
                        return data;
                    },
                    orderable: false
                    }
                
                ]
            });// end datatable
        });
    </script>
@endsection