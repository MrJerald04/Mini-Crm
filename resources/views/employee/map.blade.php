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
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">Map</h1>
          <p class="text-muted">Note: The <strong>circle</strong> mark in the map is for <strong>companies</strong> and the <strong>backward arrow</strong> is for <strong>employees</strong></p>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
     
        <div id="map"></div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection