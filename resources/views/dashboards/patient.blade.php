@extends('layouts.level1.plain')

@section('content')
  <div class="col-12 jumbotron">
    <div class="container">
      <h1 class="display-4">Hello, {{ Auth::user()->name }}</h1>
    </div>
  </div>
  <div class="col-12">
    <div class="row">
      <div class="col-12 col-md-4">
        <h4 class="font-weight-light">Appointments</h4>
        <p>Check scheduled appointments.</p>
        <p><a class="btn btn-primary" href="{{ route('appointments.my') }}" role="button">View</a></p>
      </div>
      <div class="col-12 col-md-4">
        <h4 class="font-weight-light">Doctors</h4>
        <p>Check for the specialists available.</p>
        <p><a class="btn btn-primary" href="{{ route('doctors.index') }}" role="button">View</a></p>
      </div>
      @if (Auth::user()->patient->hasRecords() && Auth::user()->patient->viewhistory)
        <div class="col-12 col-md-4">
          <h4 class="font-weight-light">Records</h4>
          <p>View you medical history.</p>
          <p><a class="btn btn-primary" href="{{ route('records.my') }}" role="button">View</a></p>
        </div>
      @endif
    </div>
  </div>
@endsection
