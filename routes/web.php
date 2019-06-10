<?php

Auth::routes();

Route::get('',           'HomeController@index'     )->name('externals.welcome');
Route::get('/',          'HomeController@index'     )->name('externals.welcome');

Route::get('locate',     'HomeController@locate'    )->name('externals.locate');
Route::get('contact',    'HomeController@contact'   )->name('externals.contact');
Route::post('contact',   'HomeController@reach'     )->name('externals.reach');

Route::middleware('auth')->group(function() {
  //Resources
  Route::resource('media',          'MediaController',         ['only' => ['destroy', 'show']]);
  Route::resource('users',          'UserController',          ['except' => ['store']]);
  Route::resource('doctors',        'DoctorController',        ['except' => ['show']]);
  Route::resource('appointments',   'AppointmentController',   ['except' => ['edit', 'update']]);
  Route::resource('patients',       'PatientController',       ['except' => ['show', 'destroy']]);
  Route::resource('schedules',      'ScheduleController',      ['except' => ['show', 'edit', 'update']]);
  Route::resource('roles',          'RoleController',          ['except' => ['show', 'edit', 'update']]);
  Route::resource('records',        'RecordController',        ['except' => ['index', 'show', 'create']]);
  Route::resource('contacts',       'ContactController',       ['except' => ['show', 'create', 'store', 'destroy']]);

  //Specific Routes
  Route::get('home/{d?}',                           'HomeController@index'                   )->name('home');
  Route::get('backup',                              'DatabaseController@backup'              )->name('databases.backup');
  Route::get('getbackup',                           'DatabaseController@getBackup'           )->name('databases.download');
  Route::get('users/{user}/avatar',                 'UserController@editAvatar'              )->name('avatar.edit');
  Route::post('avatar/{user}',                      'UserController@updateAvatar'            )->name('avatar.update');

  Route::get('write/{did?}',                        'HomeController@write'                   )->name('home.write');
  Route::post('print',                              'HomeController@print'                   )->name('home.print');

  Route::get('catalogs',                            'HomeController@editCatalog'             )->name('catalogs.edit');
  Route::put('catalogs',                            'HomeController@updateCatalog'           )->name('catalogs.update');

  Route::get('vitals/{pid}',                        'VitalController@index'                  )->name('vitals.index');
  Route::get('file/{medium}',                       'MediaController@deliver'                )->name('media.deliver');

  Route::get('schedules/{did}',                     'ScheduleController@show'                )->name('schedules.show');
  Route::get('schedules/{did}/{json?}',             'ScheduleController@show'                )->name('schedules.list');
  Route::get('doctors/{pid?}/{did?}',               'DoctorController@index'                 )->name('doctors.index');

  Route::get('users/{user}/suspend',                'UserController@suspend'                 )->name('users.suspend');
  Route::post('users/{user}/activate',              'UserController@activate'                )->name('users.activate');

  Route::get('doctor/{id?}',                        'UserController@profile'                 )->name('profile.doctor');
  Route::get('patient/{id?}',                       'UserController@profile'                 )->name('profile.patient');

  Route::get('patients/search/{term}',              'PatientController@find'                 )->name('patients.find');
  Route::post('patients/search',                    'PatientController@search'               )->name('patients.search');

  Route::get('myrecords',                           'RecordController@myRecords'             )->name('records.my');
  Route::get('mydoctors',                           'DoctorController@myDoctors'             )->name('doctors.my');
  Route::get('changepassword',                      'UserController@changePassword'          )->name('password.change');
  Route::post('changepassword',                     'UserController@updatePassword'          )->name('password.update');
  Route::get('myappointments',                      'AppointmentController@myAppointments'   )->name('appointments.my');

  Route::get('records/{pid}',                       'RecordController@index'                 )->name('records.index');
  Route::get('records/create/{pid}',                'RecordController@create'                )->name('records.create');
  Route::get('records/{pid}/{record}',              'RecordController@show'                  )->name('records.show');

  Route::get('todayscontacts',                      'ContactController@today'                )->name('contacts.today');
  Route::get('appointments/today/{id?}',            'AppointmentController@today'            )->name('appointments.today');
  Route::get('appointments/{pid?}/{did?}',          'AppointmentController@index'            )->name('appointments.index');
  Route::get('appointments/create/{pid?}/{did?}',   'AppointmentController@create'           )->name('appointments.create');
});
