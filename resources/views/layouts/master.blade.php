<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ config('app.name', 'Mini-CRM') }}</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('/bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
  <!-- Toast -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  {{-- Custom CSS --}}
  <link rel="stylesheet" href="{{ asset('css/custom_css/custom.css') }}">

  @yield('style')
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Header and Sidebar -->
    @yield('header')
    @yield('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
          @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

  </div>
  <!-- ./wrapper -->




<!-- jQuery -->
<script src="{{asset('/bower_components/admin-lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Script to support get function in map jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('/bower_components/admin-lte/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Moment use to popup calendar in date time picker -->
<script src="{{asset('/bower_components/admin-lte/plugins/moment/moment.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('/bower_components/admin-lte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{asset('/bower_components/admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>

<!-- DataTables -->
<script src="{!! asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.js') !!}"></script>
<script src="{!! asset('/bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') !!}"></script>
<!-- Googlemap -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmwTFmrPrYrV9_1yGsjxxqXeHTO_cjEgE&libraries=places"></script>
<!-- Toast -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Custom JS -->
<script src="{{ asset('/js/custom_js/custom.js') }}"></script>
<script src="{{ asset('/js/custom_js/map.js') }}"></script>
<script>
  $(document).ready(function() {
    //datatable pagination for company, sort, search, filter (server side)
    $('#company-table').DataTable({
      "autoWidth": false,
        processing: true,
        serverSide: true,
        columnDefs: [
          { width: '50%', targets: 0 },
          { width: '40%', targets: 1 },
          { width: '10%', targets: 2 }
        ],
        ajax: '{!! url('companies-data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'website', name: 'website' },
            {
              data: 'id',
              name: 'id',
              render: function(data, type, full, meta){
                return "<a class='btn btn-dark' href='/admin/companies/"+data+"''><i class='nav-icon fas fa-eye'></i></a>";
              },
              orderable: false
            }
           
        ]
    });
    //datatable pagination for employee, sort, search, filter (server side)
    $('#employee-table').DataTable({
      "autoWidth": false,
        processing: true,
        serverSide: true,
        columnDefs: [
            { width: '50%', targets: 0 },
            { width: '40%', targets: 1 },
            { width: '10%', targets: 2 }
        ],
        ajax: '{!! route('employee.data') !!}',
        columns: [
            { data: 'last_name',
              render: function ( data, type, row ) {
                return row.last_name + ', ' + row.first_name;
              } 
            },
            { data: 'email', name: 'email'},
            {
              data: 'id',
              name: 'id',
              render: function(data, type, full, meta){
                return "<a class='btn btn-dark' href='/admin/employees/"+data+"''><i class='nav-icon fas fa-eye'></i></a>";
              },
              orderable: false
            }
        ]
    });
    // end datatable

    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    $(".my-colorpicker2").on("colorpickerChange", function(event) {
        $(".my-colorpicker2 .fa-square").css("color", event.color.toString());
    });
    // to show the name of selected file
    $(".custom-file-input").on("change", function() {
        var fileName = $(this)
            .val()
            .split("\\")
            .pop();
        $(this)
            .siblings(".custom-file-label")
            .addClass("selected")
            .html(fileName);
    });
    // for phone number input. 
    $(".only-numeric").bind("keypress", function (e) {
      var keyCode = e.which ? e.which : e.keyCode
      if (!(keyCode >= 48 && keyCode <= 57)) {
        $(".error").css("display", "inline");
        return false;
      }else{
        $(".error").css("display", "none");
      }
    });
    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT',
      format:'DD/MM/YYYY HH:mm'
    })
  });
</script>
<!-- external scripts -->
@yield('script')
<!-- show message -->
@include('inc.messages')
</body>
</html>
