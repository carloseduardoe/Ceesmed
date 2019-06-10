<?php

namespace CEM\Http\Controllers;

use CEM\User;
use CEM\Doctor;
use CEM\Schedule;
use Illuminate\Http\Request;
use CEM\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
  public function index() {
    $doctors = Doctor::whereIn('id', Schedule::distinct()->pluck('doctor_id'))->with('schedules')->paginate();
    return view('crud.schedules.index', compact('doctors'));
  }

  public function create() {
    if (Auth::user()->cant('create', Schedule::class)) {
      abort(403, 'This action is unauthorized');
    }
    $doctors = User::join('doctors', 'users.id', '=', 'doctors.user_id')->get(['doctors.id', 'users.name', 'doctors.specialty']);
    return view('crud.schedules.create', compact('doctors'));
  }

  public function store(ScheduleRequest $request) {
    if (Auth::user()->cant('create', Schedule::class)) {
      abort(403, 'This action is unauthorized');
    }
    $schedule = new Schedule($request->all());
    if ($schedule->overlaps()) {
      return back()->withErrors([
        'error' => 'Overlaping schedules found.'
      ])->withInput();
    } else {
      $schedule->save();
      return redirect()->route('schedules.index')->with([
        'info' => 'Schedule created successfully.',
      ]);
    }
  }

  public function show($id, $json = false) {
    if ($json) {
      return response()->json(Schedule::where('doctor_id', $id)->get()->toArray());
    } else {
      $name = User::find($id)->name;
      $doctors = Doctor::where('user_id', $id)->with('schedules')->paginate();
      return view('crud.schedules.index', compact('name', 'doctors'));
    }
  }

  public function destroy(Schedule $schedule) {
    if (Auth::user()->cant('delete', $schedule)) {
      abort(403, 'This action is unauthorized');
    }
    $schedule->delete();
    return redirect()->route('schedules.index')->with([
      'info' => 'Schedule deleted',
    ]);
  }
}
