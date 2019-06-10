@extends('layouts.level1.plain')

@section('content')
  <div class="col-10 col-md-3 col-xl-2 pb-5">
    <div class="row w-100">
      <div class="col-12 text-center">
        <img class="w-100" id="profilepic" src="{{ Storage::url($user->avatar) }}" alt="Image Error"/>
        @if (Auth::user()->can('update', $user))
          <a class="small text-muted" href="{{ route('avatar.edit', $user->id) }}">Change Avatar</a>
        @endif
        <h4 class="pt-1">{{ $user->name }}</h4>
      </div>
    </div>
    <hr>
    <div class="row w-100">
      <div class="pl-1 my-1 col-12 col-sm-7 text-left">
        <a class="btn btn-sm text-secondary" href="{{ route('appointments.create', ["n", $user->id]) }}">Generate Appointment</a>
        <a class="btn btn-sm text-secondary" href="{{ route('appointments.index', ["n", $user->id]) }}">View Appointments</a>
        @if (!Auth::user()->isJustPatient())
          <a class="btn btn-sm text-secondary" href="{{ route('profile.patient', $user->id) }}">Patient Profile</a>
        @endif
      </div>
    </div>
  </div>
  <div class="col-10 col-md-5 pb-5">
    <div class="row">
      <h5>Specialties</h5>
    </div>
    <div class="row w-100 pb-5">
      @foreach ($doctors as $item)
        <div class="col-4 text-md-right">Specialty:</div>
        <div class="col-8">{{ $item->specialty }}</div>
        <div class="col-4 text-md-right">Position:</div>
        <div class="col-8">{{ $item->position }}</div>
        <div class="col-4 text-md-right">Availability:</div>
        @if (count($item->schedules))
          <div class="col-8">
            @foreach ($item->schedules as $schd)
              <p class="mb-1">{{ $schd->day }}: {{ substr($schd->start, 0, -3) }} - {{ substr($schd->end, 0, -3) }}</p>
            @endforeach
          </div>
        @else
          <div class="col-8">
            <p class="mb-1">No schedules assigned.</p>
          </div>
        @endif
      @endforeach
    </div>
    <div class="row">
      <h5>Recent Appointments</h5>
      <a class="btn btn-sm" href="{{ route('appointments.index', ["n", $user->id]) }}">View all</a>
    </div>
    <div class="row w-100 pl-md-5">
      <table class="table table-sm">
        <thead class="table-active">
          <tr>
            <th>Date</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($appointments as $key => $item)
            <tr>
              <td>{{ Carbon\Carbon::parse($item->time)->format('j F Y\\, H:i') }}</td>
              <td>{{ $item->type }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @if (!Auth::user()->isJustPatient())
    <div class="col-10 col-md-4 pb-5">
      <div class="row">
        <h5>User Data</h5>
        @if (Auth::user()->hasRole(['admin']))
          <a class="btn btn-sm" href="{{ route('users.edit', $user->id) }}">Update</a>
        @endif
      </div>
      <div class="row w-100 pb-5">
        <div class="col-4 text-md-right">E-Mail:</div>
        <div class="col-8">{{ $user->email }}</div>
      </div>
      <div class="row">
        <h5>Contact information</h5>
        @if (!Auth::user()->isJustPatient())
          <a class="btn btn-sm" href="{{ route('contacts.edit', $user->id) }}">Update</a>
        @endif
      </div>
      <div class="row w-100">
        <div class="col-4 text-md-right">Phone:</div>
        <div class="col-8">{{ $contact->phone }}</div>
        <div class="col-4 text-md-right">Address:</div>
        <div class="col-8">{{ $contact->address }}</div>
        <div class="col-4 text-md-right">Mobile:</div>
        <div class="col-8">{{ $contact->mobile }}</div>
        <div class="col-4 text-md-right">City:</div>
        <div class="col-8">{{ $contact->city }}</div>
      </div>
    </div>
  @endif
@endsection

@section('javascript')
  <script type="text/javascript"></script>
@endsection
