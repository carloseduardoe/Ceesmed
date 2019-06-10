<?php

namespace CEM\Policies;

use CEM\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
  use HandlesAuthorization;

  public function index(User $user) {
    return $user->hasRole(['admin']);
  }

  public function view(User $user, User $User) {
    return $user->hasRole(['admin', 'agent', 'doctor'])
            || Gate::allows('Ownership', [$User, 'id', 'id']);
  }

  public function create(User $user) {
    return $user->hasRole(['admin', 'agent', 'doctor']);
  }

  public function update(User $user, User $User) {
    return $user->hasRole(['admin', 'agent', 'doctor'])
            || Gate::allows('Ownership', [$User, 'id', 'id']);
  }

  public function delete(User $user, User $User) {
    return $user->hasRole(['admin', 'doctor']);
  }
}
