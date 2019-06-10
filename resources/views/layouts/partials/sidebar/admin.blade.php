@php
  $items = [
    'Database Backup' => 'databases.backup',
    'Parameter Setup' => 'catalogs.edit',
    'Role Setup'      => 'roles.index',
    'Users'           => 'users.index',
    'Contacts'        => 'contacts.index',
    'Schedules'       => 'schedules.index',
  ];

  if (!Auth::user()->hasRole(['agent', 'doctor'])) {
    $items = array_merge($items, [
      'Doctors'          => 'doctors.index',
      'Patients'         => 'patients.index',
      'Register Patient' => 'patients.create',
      'Appointments'     => 'appointments.index',
    ]);
  }
@endphp

@foreach ($items as $key => $value)
  <a class="col-sm-12 list-group-item list-group-item-action border-0 {!! Route::currentRouteName() == $value ? "active" : "" !!}" href="{{ route($value) }}">
    {{ $key }}
  </a>
@endforeach
