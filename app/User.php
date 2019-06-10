<?php

namespace CEM;

use CEM\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable, TextSearch;

  protected $fillable = [
    'active', 'nid', 'name', 'email', 'password', 'avatar',
  ];

  protected $hidden = [
    'password', 'remember_token',
  ];

  protected $searchable = [
    'name', 'nid', 'email'
  ];

  public function avatar() {
    return Storage::download($this->avatar);
  }

  public function contact() {
    return $this->hasOne(Contact::class, 'user_id');
  }

  public function patient() {
    return $this->hasOne(Patient::class, 'user_id');
  }

  public function doctors() {
    return $this->hasMany(Doctor::class, 'user_id');
  }

  public function roles() {
    return $this->belongsToMany(Role::class);
  }

  public function roleNames() {
    return $this->roles()->pluck('name');
  }

  public function isJustPatient() {
    return !$this->hasRole(['admin', 'agent', 'doctor']);
  }

  public function hasRole(array $roles) {
    $val = false;
    foreach ($roles as $role) {
      if ($this->roles()->where('name', $role)->first()) {
        $val = true;
        break;
      }
    }
    return $val;
  }

  public function authorize(array $roles) {
    if ($this->hasRole($roles)) {
      return true;
    }
    abort(401, 'This action is unauthorized.');
  }

  public function sendPasswordResetNotification($token) {
    Mail::to($this->email, $this->name)
    ->send(new Message([
      'header'  => 'Password Reset',
      'body'    => 'Hello '.$this->name.', we have received a password reset request for your account, please click the button below to continue:',
      'action'  => 'Reset Password',
      'url'     => route('password.reset', $token),
      'color'   => 'info',
    ], "Password Reset"));
  }
}
