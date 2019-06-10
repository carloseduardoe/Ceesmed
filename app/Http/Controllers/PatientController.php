<?php

namespace CEM\Http\Controllers;

use CEM\User;
use CEM\Role;
use CEM\Contact;
use CEM\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use CEM\Http\Requests\PatientRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
  public function find($term) {
    return response()->json(User::search($term)->get(['id', 'name'])->toArray());
  }

  public function search(Request $request) {
    if (Auth::user()->cant('index', Patient::class)) {
      abort(403, 'This action is unauthorized.');
    }

    $patients = Patient::whereIn('user_id', User::search($request->searchTerm)->pluck('id'))
    ->with('user')->join('users', 'patients.user_id', '=', 'users.id')
    ->orderBy('users.name', 'ASC')->paginate();
    return view('crud.patients.index', compact('patients'));
  }

  public function index() {
    if (Auth::user()->cant('index', Patient::class)) {
      abort(403, 'This action is unauthorized.');
    }

    $patients = Patient::with('user')->join('users', 'patients.user_id', '=', 'users.id')
    ->orderBy('users.name', 'ASC')->paginate();
    return view('crud.patients.index', compact('patients'));
  }

  public function create() {
    if (Auth::user()->cant('create', Patient::class)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.patients.create');
  }

  public function store(Request $request) {
    if (Auth::user()->cant('create', Patient::class)) {
      abort(403, 'This action is unauthorized.');
    }

    Validator::make($request->all(), [
      'nid'       => 'nullable|digits:10|unique:users',
      'name'      => 'required|string|max:100',
      'email'     => 'nullable|string|email|max:100',
      'birthdate' => 'required|date|before_or_equal:now|after_or_equal:1900/01/01',
      'gender'    => 'required|in:m,f,*|size:1',
      'bloodtype' => 'nullable|in:A +,A -,A *,B +,B -,B *,AB+,AB-,AB*,O +,O -,O *,*',
      'notes'     => 'nullable|string|max:255',
      'phone'     => 'nullable|numeric|digits_between:6,12',
      'mobile'    => 'nullable|numeric|digits_between:6,12',
      'address'   => 'nullable|string|max:200',
      'city'      => 'nullable|string|max:200',
    ],[
      'nid.unique' => 'The requested ID has already been registered.',
    ])->validate();

    $user = User::create([
      'nid'            => $request->nid ?: "",
      'name'           => $request->name,
      'email'          => $request->email ?: "no email",
      'password'       => bcrypt(Carbon::now()->format('F j\\, Y')),
      'remember_token' => str_random(10),
      'active'         => false,
    ]);
    $user->roles()->attach(Role::where('name', 'patient')->first());
    Patient::create([
      'user_id'   => $user->id,
      'birthdate' => $request->birthdate,
      'gender'    => $request->gender,
      'bloodtype' => $request->bloodtype ?: "*",
      'notes'     => $request->notes ?: "",
    ]);
    Contact::create([
      'user_id' => $user->id,
      'phone'   => $request->phone ?: "",
      'mobile'  => $request->mobile ?: "",
      'address' => $request->address ?: "",
      'city'    => $request->city ?: "",
    ]);

    return redirect()->route('profile.patient', $user->id)->with([
      'info' => 'Patient registered successfully.',
    ]);
  }

  public function edit(Patient $patient) {
    if (Auth::user()->cant('update', $patient)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.patients.edit', compact('patient'));
  }

  public function update(PatientRequest $request, Patient $patient) {
    if (Auth::user()->cant('update', $patient)) {
      abort(403, 'This action is unauthorized.');
    }

    $patient->birthdate = $request->birthdate;
    $patient->gender    = $request->gender;
    $patient->bloodtype = $request->bloodtype;
    if (Auth::user()->hasRole(['admin', 'doctor'])) {
      $patient->notes = $request->notes;
      $patient->viewhistory = $request->viewhistory == "on";
    }
    $patient->save();

    return redirect()->route('profile.patient', $patient->user_id)->with([
      'info' => 'Patient information updated successfully',
    ]);
  }
}
