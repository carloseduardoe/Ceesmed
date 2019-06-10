@extends('layouts.level1.main')

@section('content')
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">Hello, {{ Auth::user()->name }}</h1>
    </div>
  </div>
  <div class="row pb-3">
    <div class="col">
      <h2>Admin Dashboard</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h4 class="font-weight-light">Users</h4>
      <small class="d-block mb-3">Activate, suspend or modify users.</small>
      <p><a class="btn btn-primary" href="{{ route('users.index') }}" role="button">View</a></p>
    </div>
    <div class="col-md-4">
      <h4 class="font-weight-light">Patients</h4>
      <small class="d-block mb-3">Manage specific information about patients.</small>
      <p><a class="btn btn-primary" href="{{ route('patients.index') }}" role="button">View</a></p>
    </div>
    <div class="col-md-4">
      <h4 class="font-weight-light">Doctors</h4>
      <small class="d-block mb-3">View or edit details about your doctors.</small>
      <p><a class="btn btn-primary" href="{{ route('doctors.index') }}" role="button">View</a></p>
    </div>
  </div>
@endsection
