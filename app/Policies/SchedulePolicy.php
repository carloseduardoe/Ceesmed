<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Schedule;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
  use HandlesAuthorization;

  public function create(User $user) {
    return $user->hasRole(['admin']);
  }

  public function delete(User $user, Schedule $Appointment) {
    return $user->hasRole(['admin']);
  }
}
