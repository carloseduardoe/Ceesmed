<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
  use HandlesAuthorization;

  public function view(User $user, Doctor $Doctor) {
    return $user->active;
  }

  public function create(User $user) {
    return $user->hasRole(['admin']);
  }

  public function update(User $user, Doctor $Doctor) {
    return $user->hasRole(['admin', 'agent']);
  }

  public function delete(User $user, Doctor $Doctor) {
    return $user->hasRole(['admin']);
  }
}
