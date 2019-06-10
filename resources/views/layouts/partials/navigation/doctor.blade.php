@php
  $items = [
    'Doctors'          => 'doctors.index',
    'Patients'         => 'patients.index',
    'Register Patient' => 'patients.create',
    'Appointments'     => 'appointments.index',
  ];
@endphp

<li class="nav-item dropdown d-block d-md-none d-xl-none">
  <a class="nav-link dropdown-toggle" href="" id="barddown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Doctor</a>
  <div class="dropdown-menu" aria-labelledby="barddown">
    @foreach ($items as $key => $value)
      <a class="dropdown-item {{ Route::currentRouteName() == $value ? "active" : "" }}"
         href="{{ route($value) }}">
        {{ $key }}
      </a>
    @endforeach
  </div>
</li>
