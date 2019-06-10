<?php

namespace CEM\Http\Controllers;

use CEM\User;
use CEM\Role;
use CEM\Doctor;
use CEM\Appointment;
use Illuminate\Http\Request;
use CEM\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
  public function index($pid = "n", $did = "n") {
    $user = Auth::user();
    if ($user->isJustPatient() && ($pid != "n" && $pid != $user->id)) {
      abort(403, 'This action is unauthorized.');
    }

    $doctors = DB::table('doctors');

    if ($pid != "n" || $did != "n") {
      $doctors = $doctors->whereIn('id', Appointment::where('patient_id', $pid)->pluck('doctor_id'))->orWhere('id', $did);
    }
    $doctors = $doctors->orderBy('user_id')->paginate();

    return view('crud.doctors.index', compact('doctors'));
  }

  public function myDoctors() {
    return $this->index(Auth::user()->id, "n");
  }

  public function create() {
    if (Auth::user()->cant('create', Doctor::class)) {
      abort(403, 'This action is unauthorized.');
    }
    $users = User::get(['id','name']);
    return view('crud.doctors.create', compact('users'));
  }

  public function store(DoctorRequest $request) {
    if (Auth::user()->cant('create', Doctor::class)) {
      abort(403, 'This action is unauthorized.');
    }
    $doctor = Doctor::create($request->all());
    $user = User::find($doctor->user_id);
    if (!$user->hasRole(['doctor'])) {
      $user->roles()->attach(Role::where('name', 'doctor')->first());
    }
    $user->active = true;
    $user->save();

    return redirect()->route('doctors.index')->with([
      'info' => 'Please assign a schedule to your doctor. <a href="'.route('schedules.create').'">Create Schedule</a>',
    ]);
  }

  public function show(Doctor $doctor) {
    if (Auth::user()->cant('view', $doctor)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.doctors.show', compact('doctor'));
  }

  public function edit(Doctor $doctor) {
    if (Auth::user()->cant('update', $doctor)) {
      abort(403, 'This action is unauthorized.');
    }

    return view('crud.doctors.edit', compact('doctor'));
  }

  public function update(DoctorRequest $request, Doctor $doctor) {
    if (Auth::user()->cant('update', $doctor)) {
      abort(403, 'This action is unauthorized.');
    }

    $doctor->specialty = $request->specialty;
    $doctor->position = $request->position;
    $doctor->save();
    return redirect()->route('doctors.index');
  }

  public function destroy(Doctor $doctor) {
    if (Auth::user()->cant('delete', $doctor)) {
      abort(403, 'This action is unauthorized.');
    }

    if (Doctor::where('user_id', $doctor->user_id)->count() == 1) {
      User::find($doctor->user_id)->roles()->detach(Role::where('name', 'doctor')->first());
    }
    $doctor->delete();

    return redirect()->route('doctors.index')->with([
      'info' => 'Doctor deleted.',
    ]);
  }
}
