<?php

namespace CEM\Http\Controllers\Auth;

use CEM\User;
use CEM\Role;
use CEM\Contact;
use CEM\Patient;
use CEM\Mail\Message;
use Illuminate\Http\Request;
use CEM\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
  use RegistersUsers;

  protected $redirectTo = 'home';

  public function __construct() {
    // $this->middleware('guest');
  }

  public function register(Request $request)
  {
    $this->validator($request->all())->validate();

    $user = $this->create($request->all());
    // event(new Registered($user = $this->create($request->all())));
    // $this->guard()->login($user);
    // return $this->registered($request, $user) ?: redirect($this->redirectPath());

    if (Auth::check()) {
      return $this->registered($request, $user) ?: redirect()->route('profile.patient', $user->id);
    } else {
      return $this->registered($request, $user) ?: redirect()->route('externals.welcome')->with([
        'info' => 'Account registered successfully.',
      ]);
    }
  }

  protected function validator(array $data) {
    return Validator::make($data, [
      'name'                  => 'required|string|max:255',
      'nid'                   => 'required|digits:10|unique:users',
      'email'                 => 'required|string|email|max:255|unique:users',
      'password'              => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\w])[a-zA-Z\d$@#!%*?&].+$/|min:6|max:20|confirmed',
      'password_confirmation' => 'required|same:password',
    ] , [
      'password.regex'        => 'The password must include at least a lowercase letter, an uppercase letter and may include numbers and symbols.',
    ]);
  }

  protected function create(array $data) {
    $user =  User::create([
      'name'     => $data['name'],
      'nid'      => $data['nid'],
      'email'    => $data['email'],
      'password' => bcrypt($data['password']),
    ]);
    $user->roles()->attach(Role::where('name', 'patient')->first());

    $contact = new Contact();
    $contact->user_id = $user->id;
    $contact->save();

    $patient = new Patient();
    $patient->user_id = $user->id;
    $patient->save();

    Mail::to($user->email)->send(new Message([
      'header' => 'Welcome',
      'body'   => "Hello ".$user->name."! We would like to thank you for registering with us, an admin should contact you once your account has been approved for login. Meanwhile you can contact us using the contact form.\n\nThanks, we'll keep in touch.\nThe ".env('APP_NAME')." team.",
      'action' => 'Visit Us',
      'url'    => route('externals.welcome'),
      'color'  => 'secondary',
    ], "Welcome"));

    return $user;
  }
}
