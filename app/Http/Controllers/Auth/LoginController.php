<?php

namespace CEM\Http\Controllers\Auth;

use CEM\User;

use Illuminate\Http\Request;
use CEM\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  // Where to redirect users after login.
  protected $redirectTo = '/home';

  public function __construct() {
    $this->middleware('guest')->except('logout');
  }

  public function authenticate() {
    if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
      return redirect()->intended($redirectTo);
    }
  }

  public function login(Request $request) {
    $user = User::where('email', $request->email)->first();
    if ($user && $user->active) {
      $this->validateLogin($request);

      if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return $this->sendLockoutResponse($request);
      }

      if ($this->attemptLogin($request)) {
          return $this->sendLoginResponse($request);
      }

      $this->incrementLoginAttempts($request);

      return $this->sendFailedLoginResponse($request);
    } else {
      Abort(401, 'The user is not authorized to perform this action.');
    }
  }
}
