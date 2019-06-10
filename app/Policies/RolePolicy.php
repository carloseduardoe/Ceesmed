<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
  use HandlesAuthorization;

  public function index(User $user) {
    return $user->hasRole(['admin']);
  }

  public function create(User $user) {
    return $user->hasRole(['admin']);
  }

  public function delete(User $user, Role $role) {
    return $user->hasRole(['admin']);
  }
}
