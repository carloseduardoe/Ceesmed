<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Patient;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
  use HandlesAuthorization;

  public function index(User $user) {
    return $user->hasRole(['admin', 'agent', 'doctor']);
  }

  public function view(User $user, Patient $patient) {
    return $user->hasRole(['admin', 'agent', 'doctor'])
            || Gate::allows('Ownership', [$patient, 'id', 'user_id']);
  }

  public function create(User $user) {
    return $user->hasRole(['admin', 'agent', 'doctor']);
  }

  public function update(User $user, Patient $patient) {
    return $user->hasRole(['admin', 'agent', 'doctor'])
            || Gate::allows('Ownership', [$patient, 'id', 'user_id']);
  }
}
