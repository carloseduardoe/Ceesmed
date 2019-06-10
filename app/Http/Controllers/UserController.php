<?php

namespace CEM\Http\Controllers;

use CEM\User;
use CEM\Medium;
use CEM\Schedule;
use CEM\Appointment;
use CEM\Mail\Message;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use CEM\Http\Requests\UserRequest;
use CEM\Http\Requests\PasswordRequest;
use CEM\Http\Requests\AvatarRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function index() {
    if (Auth::user()->cant('index', User::class)) {
      abort(403, 'This action is unauthorized.');
    }
    $users = User::orderBy('updated_at', 'DESC')->paginate();
    return view('crud.users.index', compact('users'));
  }

  public function create() {
    if (Auth::user()->cant('create', User::class)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('auth.register');
  }

  public function show(User $user) {
    if (Auth::user()->cant('view', $user)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.users.show', compact('user'));
  }

  public function edit(User $user) {
    if (Auth::user()->cant('update', $user)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.users.edit', compact('user'));
  }

  public function update(UserRequest $request, User $user) {
    if (Auth::user()->cant('update', $user)) {
      abort(403, 'This action is unauthorized.');
    }
    $user->nid = $request->nid;
    $user->name = $request->name;
    $user->email = $request->email;
    if (Auth::user()->hasRole(['admin', 'agent']) && Auth::user()->id != $user->id) {
      $user->active = $request->active == "on";
    }

    $user->save();

    return redirect()->route('profile.patient', $user->id)->with([
      'info' => 'User information updated.',
    ]);
  }

  function editAvatar(User $user){
    if (Auth::user()->cant('update', $user)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.users.editAvatar', compact('user'));
  }

  function updateAvatar(AvatarRequest $request, User $user) {
    if (Auth::user()->cant('update', $user)) {
      abort(403, 'This action is unauthorized.');
    }
    $file = $request->file('avatar');
    $name = $user->id." ".$file->getClientOriginalName();

    if (in_array($user->avatar, Storage::files('public/avatars')) && $user->avatar != 'public/avatars/default.png') {
      Storage::delete($user->avatar);
    }

    $filename = Storage::putFileAs('public/avatars', new File($file->path()), $name, 'public');
    if ($filename) {
      $user->avatar = $filename;
      $user->save();
    }

    return redirect()->route('profile.patient', $user->id)->with([
      'info' => 'Avatar Updated',
    ]);
  }

  public function activate(User $user){
    if (!Auth::user()->hasRole(['admin', 'doctor'])) {
      abort(403, 'This action is unauthorized.');
    }

    Validator::make(["email" => $user->email], [
      'email' => 'string|email|max:100',
    ],[
      'email.email' => "Email is not set.",
    ])->validate();

    $user->active = true;
    $user->save();
    Mail::to($user->email, $user->name)
    ->send(new Message([
      'header'  => 'Account Activation',
      'body'    => 'Hello '.$user->name.', your account has being successfully authorized for login, click the button below to start browsing:',
      'action'  => 'Visit',
      'url'     => route('home'),
      'color'   => 'success',
    ], "Account Activation"));

    return back()->with([
      'info' => 'User activated successfully.',
    ]);
  }

  public function suspend(User $user){
    if (Auth::user()->cant('delete', $user)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('auth.suspend', compact('user'));
  }

  public function destroy(Request $request) {
    $user = User::find($request->user_id);
    if (Auth::user()->cant('delete', $user)) {
      abort(403, 'This action is unauthorized.');
    }
    if ($user->email == $request->email && Auth::user()->id != $request->user_id) {
      $user->active = false;
      $user->save();
      return redirect()->route('profile.patient', $user->id)->with(['info' => 'User has been suspended.']);
    } else {
      return back()->withErrors(['user' => 'Incorrect parameters.']);
    }
  }

  public function profile($id = null) {
    $user = User::find(($id == null || $id == 0) ? Auth::user()->id : $id);
    if (Auth::user()->cant('view', $user) && Route::currentRouteName() != 'profile.doctor') {
      abort(403, 'This action is unauthorized.');
    }

    if (Route::currentRouteName() == 'profile.patient') {
      $record = $user->patient->records()->orderBy('updated_at', 'DESC')->first();
      return view('profiles.patient')->with([
        'user'    => $user,
        'patient' => $user->patient,
        'contact' => $user->contact,
        'record'  => $record,
        'vitals'  => $record != null ? $record->vitals : null,
      ]);
    } elseif (Route::currentRouteName() == 'profile.doctor' & $user->hasRole(['doctor'])) {
      return view('profiles.doctor')->with([
        'user'         => $user,
        'contact'      => $user->contact,
        'doctors'      => $user->doctors()->with('schedules')->get(),
        'appointments' => Appointment::where('doctor_id', $user->id)->orderBy('time', 'DESC')->take(5)->get(['time', 'type']),
      ]);
    } else {
      return redirect()->route('home')->with([
        'info' => 'The requested profile is unavailable.'
      ]);
    }
  }

  public function changePassword() {
    return view('auth.passwords.change');
  }

  public function updatePassword(PasswordRequest $request) {
    if ($request->current == $request->new) {
      return back()->withErrors([
        'new' => 'The new password cannot be the same as the current one.'
      ]);
    }
    if (!Hash::check($request->current, Auth::user()->password)) {
      return back()->withErrors([
        'current' => 'Password mismatch.'
      ]);
    }

    $user = Auth::user();
    $user->password = bcrypt($request->new);
    $user->save();

    Mail::to($user->email, $user->name)
    ->send(new Message([
      'header'  => 'Password Change Confirmation',
      'body'    => 'Hello '.$user->name.', you have successfully updated your password.',
      'action'  => 'Browse',
      'url'     => url('home'),
      'color'   => 'primary',
    ]));

    return redirect()->route('profile.patient', Auth::user()->id)->with([
      'info' => 'Password updated successfully.'
    ]);
  }
}
