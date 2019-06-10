<?php

namespace CEM\Http\Controllers;

use CEM\Patient;
use CEM\Record;
use CEM\Vital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use CEM\Http\Requests\VitalRequest;

class VitalController extends Controller
{
  public function index($pid) {
    if (Auth::user()->cant('view', Vital::find(Record::where('patient_id', $pid)->first()->id))) {
      abort(403, 'This action is unauthorized');
    }

    $vitals = DB::table('vitals')
    ->join('records', 'vitals.record_id', '=', 'records.id')
    ->whereIn('vitals.record_id', Record::where('patient_id', $pid)->pluck('id'))
    ->orderBy('records.created_at', 'DESC')
    ->select('vitals.*', 'records.created_at')->get();
    return response()->json($vitals);
  }
}
