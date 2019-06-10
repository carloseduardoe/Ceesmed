@extends('layouts.level1.plain')

@php
  $viewer = Auth::user();
@endphp

@section('content')
  <div class="col-10 col-md-3 col-xl-2 pb-5">
    <div class="row w-100">
      <div class="col-12 text-center">
        <img class="w-100" id="profilepic" src="{{ Storage::url($user->avatar) }}" alt="Image Error"/>
        @if ($viewer->can('update', $user))
          <a class="small text-muted" href="{{ route('avatar.edit', $user->id) }}">Change Avatar</a>
        @endif
        <h4 class="pt-1">{{ $user->name }}</h4>
      </div>
    </div>
    <hr>
    <div class="row w-100">
      <div class="pl-1 my-1 col-12 col-sm-7 text-left">
        <a class="btn btn-sm text-secondary" href="{{ route('appointments.create', [$user->id, "n"]) }}">Generate Appointment</a>
        <a class="btn btn-sm text-secondary" href="{{ route('appointments.index', [$user->id, "n"]) }}">View Appointments</a>
        @if ($viewer->hasRole(['admin', 'doctor']))
          <a class="btn btn-sm text-secondary" href="{{ route('records.create', $user->id) }}">Generate Record</a>
        @endif
        @if ($user->patient->hasRecords() && ($user->patient->viewhistory || $viewer->hasRole(['admin', 'doctor'])))
          <a class="btn btn-sm text-secondary" href="{{ route('records.index', $user->id) }}">Medical History</a>
        @endif
        @if ($user->hasRole(['doctor']))
          <a class="btn btn-sm text-secondary" href="{{ route('profile.doctor', $user->id) }}">Doctor Profile</a>
        @endif
          <a class="btn btn-sm text-danger" href="{{ route('password.request') }}">Password Reset</a>
        @if ($viewer->hasRole(['admin', 'doctor']))
          @if ($user->active)
            <a class="btn btn-sm text-danger" href="{{ route('users.suspend', $user->id) }}">Suspend</a>
          @else
            <form class="pt-1 d-inline-block" action="{{ route('users.activate', $user->id) }}" method="post">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-sm btn-link text-success">Activate</button>
            </form>
          @endif
        @endif
      </div>
    </div>
  </div>
  <div class="col-10 col-md-5 pb-5">
    <div class="row">
      <h5>Patient Information</h5>
      <a class="btn btn-sm" href="{{ route('patients.edit', $user->id) }}">Update</a>
    </div>
    <div class="row">
      <div class="col-4 text-md-right">Birthdate</div>
      <div class="col-8">{{ Carbon\Carbon::parse($patient->birthdate)->format('F j\\, Y') }}<br/><small>({{ Carbon\Carbon::parse($patient->birthdate)->diff(Carbon\Carbon::now())->format('%y years, %m months') }})</small></div>
      <div class="col-4 text-md-right">Gender</div>
      <div class="col-8">{!! $patient->gender == 'm' ? 'male' : ($patient->gender == 'f' ? 'female' : 'unknown') !!}</div>
      <div class="col-4 text-md-right">Bloodtype</div>
      <div class="col-8">{{ $patient->bloodtype }}</div>
      @if ($patient->notes && $viewer->hasRole(['admin', 'doctor']))
        <div class="col-4 text-md-right">Background</div>
        <div class="col-8" style="white-space: pre-wrap;">{{ $patient->notes }}</div>
      @endif
    </div>
    @if ($user->patient->hasRecords())
    <div class="row">
      <h6>Latest history</h6>
    </div>
    <div class="row">
        <div class="col-sm-4 text-md-right">Anamnesis</div>
        <div class="col-sm-8" style="white-space: pre-wrap;">{{ $record->description }}</div>
      @if (!$viewer->isJustPatient())
        <div class="col-sm-4 text-md-right">Diagnosis</div>
        <div class="col-sm-8" style="white-space: pre-wrap;">{{ $record->diagnosis }}</div>
        <div class="col-sm-4 text-md-right">Prescription</div>
        <div class="col-sm-8" style="white-space: pre-wrap;">{{ $record->prescription }}</div>
        <div class="col-4 text-md-right">Pulse</div>
        <div class="col-8">{{ $vitals->pulse }} bpm</div>
        <div class="col-4 text-md-right">Temperature</div>
        <div class="col-8">{{ $vitals->temperature }} °C</div>
        <div class="col-4 text-md-right">Systolic p.</div>
        <div class="col-8">{{ $vitals->bpsystolic }} mm Hg</div>
        <div class="col-4 text-md-right">Diastolic p.</div>
        <div class="col-8">{{ $vitals->bpdiastolic }} mm Hg</div>
        <div class="col-4 text-md-right">Height</div>
        <div class="col-8">{{ $vitals->height }} cm</div>
        <div class="col-4 text-md-right">Weight</div>
        <div class="col-8">{{ $vitals->weight }} kg</div>
      @endif
    </div>
    @endif
  </div>
  <div class="col-10 col-md-4 pb-5">
    <div class="row">
      <h5>User Data</h5>
      <a class="btn btn-sm" href="{{ route('users.edit', $user->id) }}">Update</a>
    </div>
    <div class="row">
      <div class="col-4 text-md-right">ID</div>
      <div class="col-8">{{ $user->nid }}</div>
      <div class="col-4 text-md-right">E-Mail</div>
      <div class="col-8" style="overflow-wrap: break-word;">{{ $user->email }}</div>
    </div>
    <hr/>
    <div class="row">
      <h5>Contact information</h5>
      <a class="btn btn-sm" href="{{ route('contacts.edit', $user->id) }}">Update</a>
    </div>
    <div class="row">
      <div class="col-4 text-md-right">Phone</div>
      <div class="col-8">{{ $contact->phone }}</div>
      <div class="col-sm-4 text-md-right">Address</div>
      <div class="col-sm-8">{{ $contact->address }}</div>
      <div class="col-4 text-md-right">Mobile</div>
      <div class="col-8">{{ $contact->mobile }}</div>
      <div class="col-4 text-md-right">City</div>
      <div class="col-8">{{ $contact->city }}</div>
    </div>
  </div>
  @if ($user->patient->hasRecords() && !$viewer->isJustPatient())
    <script type="text/javascript">
    var patient = {
      birthdate: "{{ $patient->birthdate }}",
      bloodtype: "{{ $patient->bloodtype }}",
      gender:    "{{ $patient->gender }}"
    };
    var birthdate = new Date("{{ $patient->birthdate }}");
    var vitals = null;

    function zIndex(bmi, l, m, s) {
      var zi = (pow(bmi / m, l) - 1) / (s * l);

      if (!Math.abs(zi) <= 3) {
        if (zi > 3) {
          zi = 3 + ((bmi - SD(3, l, m, s)) / (SD(3, l, m, s) - SD(2, l, m, s)));
        } else {
          zi = -3 + ((bmi - SD(-3, l, m, s)) / (SD(-2, l, m, s) - SD(-3, l, m, s)));
        }
      }

      return zi;
    }

    function SD(a, l, m, s) {
      return m * Math.pow((1 + (a * l * s)), (1 / l));
    }
    </script>
    @if ($patient->gender == 'm')
      @include('profiles.patient.maledata')
    @else
      @include('profiles.patient.femaledata')
    @endif
    <script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
    @include('profiles.patient.heightGraph')
    @include('profiles.patient.weightGraph')
    @include('profiles.patient.weightHeightGraph')
    @include('profiles.patient.BMIGraph')
  @endif
@endsection

@section('javascript')
  @if ($user->patient->hasRecords() && !$viewer->isJustPatient())
    <script type="text/javascript">
      try {
        window.$ = window.jQuery;
        window.onload = function() {
          $.ajax({
            url: "{!! url('vitals/'.$patient->user_id) !!}",
            dataType: 'json',
            success: function(data) {
              vitals = data;
              window.initHeightChart();
              window.initWeightChart();
              window.initWeightHeightChart();
              window.initBMIChart();
            }
          });
        };
      } catch (e) {
        console.error(e);
      }
    </script>
  @endif
@endsection
