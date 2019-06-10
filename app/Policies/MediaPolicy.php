<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Medium;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
  use HandlesAuthorization;

  public function view(User $user, Medium $medium) {
    return ($user->patient->viewhistory && $medium->record->patient_id == $user->id)
        || $user->hasRole(['admin', 'doctor']);
  }

  public function delete(User $user, Medium $medium) {
    return $user->hasRole(['admin', 'doctor']);
  }
}
