<?php

namespace CEM\Providers;

use CEM\Appointment;
use CEM\Policies\AppointmentPolicy;
use CEM\Contact;
use CEM\Policies\ContactPolicy;
use CEM\Doctor;
use CEM\Policies\DoctorPolicy;
use CEM\Patient;
use CEM\Policies\PatientPolicy;
use CEM\Record;
use CEM\Policies\RecordPolicy;
use CEM\Medium;
use CEM\Policies\MediaPolicy;
use CEM\Vital;
use CEM\Policies\VitalPolicy;
use CEM\Role;
use CEM\Policies\RolePolicy;
use CEM\Schedule;
use CEM\Policies\SchedulePolicy;
use CEM\User;
use CEM\Policies\UserPolicy;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  protected $policies = [
    Appointment::class => AppointmentPolicy::class,

    Contact::class     => ContactPolicy::class,
    Patient::class     => PatientPolicy::class,

    Record::class      => RecordPolicy::class,
    Medium::class      => MediaPolicy::class,
    Vital::class       => VitalPolicy::class,

    User::class        => UserPolicy::class,
    Doctor::class      => DoctorPolicy::class,
    Role::class        => RolePolicy::class,
    Schedule::class    => SchedulePolicy::class,
  ];

  public function boot()
  {
    $this->registerPolicies();

    Gate::define('Ownership', function($owner, $subject, $key = 'id', $field = 'user_id') {
      return $owner->$key == $subject->$field;
    });
  }
}
