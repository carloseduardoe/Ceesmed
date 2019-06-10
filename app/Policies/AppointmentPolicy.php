<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Appointment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
  use HandlesAuthorization;

  public function view(User $user, Appointment $appointment) {
    return $user->hasRole(['admin', 'agent', 'doctor']) ||
            Gate::allows('Ownership', [$appointment, 'id', 'patient_id']);
  }

  public function create(User $user) {
    return $user->active;
  }

  public function update(User $user, Appointment $appointment) {
    return $user->hasRole(['admin', 'agent', 'doctor']);
  }

  public function delete(User $user, Appointment $appointment) {
    return $user->hasRole(['admin', 'agent'])
          || Gate::allows('Ownership', [$appointment, 'id', 'patient_id'])
          || Gate::allows('Ownership', [$appointment, 'id', 'doctor_id']);
  }
}
