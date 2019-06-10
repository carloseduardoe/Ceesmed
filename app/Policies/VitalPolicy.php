<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Vital;
use Illuminate\Auth\Access\HandlesAuthorization;

class VitalPolicy
{
  use HandlesAuthorization;

  public function view(User $user, Vital $vital) {
    return ($vital->record->patient_id == $user->id)
        || $user->hasRole(['admin', 'doctor']);
  }
}
