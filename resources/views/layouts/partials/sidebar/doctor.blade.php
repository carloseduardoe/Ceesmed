@php
  $items = [
    'Doctors'          => 'doctors.index',
    'Patients'         => 'patients.index',
    'Register Patient' => 'patients.create',
    'Appointments'     => 'appointments.index',
  ];
@endphp

@foreach ($items as $key => $value)
  <a class="col-sm-12 list-group-item list-group-item-action border-0 {!! Route::currentRouteName() == $value ? "active" : "" !!}" href="{{ route($value) }}">
    {{ $key }}
  </a>
@endforeach
