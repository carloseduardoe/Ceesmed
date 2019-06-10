@extends('layouts.level2.show')

@section('title')
Appointment
@endsection

@section('header')
  <p><strong>Patient:</strong> {{ CEM\User::find($appointment->patient_id)->name }}</p>
  <p><strong>Doctor:</strong> {{ CEM\User::find(CEM\Doctor::find($appointment->doctor_id)->user_id)->name }}</p>
@endsection

@section('details')
  <p><strong>Time & Date:</strong> {{ Carbon\Carbon::parse($appointment->time)->toDayDateTimeString() }}</p>
  <p><strong>Type:</strong> {{ $appointment->type }}</p>
  <p><strong>Reason:</strong> {{ $appointment->reason }}</p>
@endsection

@section('footer')
  <form class="d-inline-block" action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE"/>
    <button class="btn btn-sm btn-danger" type="submit" name="button">Cancel</button>
  </form>
  <a class="btn btn-sm btn-primary" href="{{ route('appointments.' . (Auth::user()->isJustPatient() ? 'my' : 'index')) }}">Appointments</a>
  <a class="btn btn-sm btn-info" href="{{ route('profile.doctor', CEM\Doctor::find($appointment->doctor_id)->user_id) }}">Doctor</a>
  <a class="btn btn-sm btn-info" href="{{ route('profile.patient', $appointment->patient_id) }}">Patient</a>
@endsection
