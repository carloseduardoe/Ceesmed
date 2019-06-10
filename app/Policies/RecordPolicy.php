<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Record;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
  use HandlesAuthorization;

  public function index(User $user) {
    return ($user->patient->viewhistory)
        || $user->hasRole(['admin', 'agent', 'doctor']);
  }

  public function view(User $user, Record $record) {
    return ($user->patient->viewhistory && $record->patient_id == $user->id)
        || $user->hasRole(['admin', 'doctor']);
  }

  public function create(User $user) {
    return $user->hasRole(['admin', 'doctor']);
  }

  public function update(User $user, Record $record) {
    return $user->hasRole(['admin', 'doctor']);
  }

  public function delete(User $user, Record $record) {
    return $user->hasRole(['admin', 'doctor']);
  }
}
