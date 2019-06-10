<?php

namespace CEM\Http\Controllers\Auth;

use CEM\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
  use SendsPasswordResetEmails;

  public function __construct() {
    // $this->middleware('guest');
  }
}
