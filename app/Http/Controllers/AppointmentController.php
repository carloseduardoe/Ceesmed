<?php

namespace CEM\Http\Controllers;

use CEM\Appointment;
use CEM\User;
use CEM\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use CEM\Http\Requests\AppointmentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
  public function index($pid = "n", $did = "n") {
    if (Auth::user()->hasRole(['admin'])) {
      $appointments = Appointment::orderBy('time', 'DESC');
    } else {
      $appointments = Appointment::orderBy('time', 'ASC')->where('time', '>=', Carbon::today()->toDateString());
    }

    $user = Auth::user();
    if ($user->isJustPatient() && (($pid == "n" && $did == "n") || ($pid != "n" && $pid != $user->id))) {
      abort(403, 'This action is unauthorized.');
    }

    if ($pid != "n" && $did != "n") {
      $appointments = $appointments->where('patient_id', $pid)->whereIn('doctor_id', Doctor::where('user_id', $did)->pluck('id'));
    } elseif ($pid != "n" && $did == "n") {
      $appointments = $appointments->where('patient_id', $pid);
    } elseif ($pid == "n" && $did != "n") {
      $appointments = $appointments->where('doctor_id', Doctor::where('user_id', $did)->pluck('id'));
    }

    $appointments = $appointments->paginate();

    return view('crud.appointments.index', compact('appointments'));
  }

  public function myAppointments() {
    return $this->index(Auth::user()->id);
  }

  public function today($id = "n") {
    if (Auth::user()->isJustPatient()) {
      abort(403, 'This action is unauthorized.');
    }

    $appointments = Appointment::whereBetween('time', [Carbon::today()->toDateString(), Carbon::tomorrow()->toDateString()]);

    if ($id == "n") {
      $id = Auth::user()->id;
      $appointments = $appointments->where(function($query) use($id) {
        $query->where('patient_id', $id)->orWhere('doctor_id', $id);
      });
    } elseif ($id != "x") {
      $appointments = $appointments->where(function($query) use($id) {
        $query->where('patient_id', $id)->orWhere('doctor_id', $id);
      });
    }

    $appointments = $appointments->orderBy('time', 'DESC')->get()->toArray();

    foreach ($appointments as &$item) {
      $item['doctor'] = Doctor::find($item['doctor_id'])->user->name;
    }

    return response()->json($appointments);
  }

  public function create($pid = "n", $did = "n") {
    if (Auth::user()->cant('create', Appointment::class)) {
      abort(403, 'This action is unauthorized.');
    }

    $patients = DB::table('users');
    if (Auth::user()->isJustPatient()) {
      $patients = $patients->where('id', Auth::user()->id);
    } elseif ($pid != "n") {
      $patients = $patients->where('id', $pid);
    }
    $patients = $patients->get(['nid', 'id', 'name']);

    $doctors = DB::table('users')->join('doctors', 'users.id', '=', 'doctors.user_id')
    ->where('active', true)->when($did != "n", function($query) use ($did) {
      return $query->where('doctors.user_id', $did);
    })
    ->select('doctors.id', 'doctors.specialty', 'users.name')->get();

    return view('crud.appointments.create')->with([
      'patients' => $patients,
      'doctors'  => $doctors,
    ]);
  }

  public function store(AppointmentRequest $request) {
    if (Auth::user()->cant('create', Appointment::class)) {
      abort(403, 'This action is unauthorized.');
    }

    $appointment = new Appointment([
      'doctor_id'  => $request->doctor_id,
      'patient_id' => $request->patient_id,
      'time'       => $request->time0.' '.$request->time1,
      'type'       => $request->type,
      'reason'     => $request->reason,
    ]);

    if ($appointment->patient_id == Doctor::find($appointment->doctor_id)->user_id) {
      return back()->withErrors([
        'Error' => 'A doctor cannot be it\'s own patient.',
      ]);
    } elseif (!$appointment->validate()) {
      return back()->withErrors([
        'Error' => 'The selected specialist has another appointment scheduled at that time.',
      ]);
    } elseif (!$appointment->onSchedule()) {
      return back()->withErrors([
        'Error' => 'The specialist is not available, at the selected time.',
      ]);
    } else {
      $appointment->save();
      return redirect()->route('appointments.show', $appointment->id)->with([
        'info' => 'Appointment created successfully.',
      ]);
    }
  }

  public function show(Appointment $appointment) {
    if (Auth::user()->cant('view', $appointment)) {
      abort(403, 'This action is unauthorized.');
    }

    return view('crud.appointments.show', compact('appointment'));
  }

  public function destroy(Appointment $appointment) {
    if (Auth::user()->cant('delete', $appointment)) {
      abort(403, 'This action is unauthorized.');
    }

    $appointment->delete();

    if (Auth::user()->isJustPatient()) {
      return redirect()->route('appointments.my')->with([
        'info' => 'Appointment successfully canceled.',
      ]);
    } else {
      return redirect()->route('appointments.index')->with([
        'info' => 'Appointment successfully canceled.',
      ]);
    }

  }
}
