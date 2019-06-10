<?php

namespace CEM\Policies;

use CEM\User;
use CEM\Contact;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
  use HandlesAuthorization;

  public function index(User $user) {
    return $user->hasRole(['admin', 'agent']);
  }

  public function view(User $user, Contact $Contact) {
    return $user->hasRole(['admin', 'agent', 'doctor'])
            || Gate::allows('Ownership', $Contact);
  }

  public function update(User $user, Contact $Contact) {
    return $user->hasRole(['admin', 'agent'])
            || Gate::allows('Ownership', $Contact);
  }
}
