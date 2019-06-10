<?php

namespace CEM\Http\Controllers;

use CEM\User;
use CEM\Record;
use CEM\Vital;
use CEM\Medium;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use CEM\Http\Requests\RecordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
  public function index($id) {
    if (User::find($id)->patient->hasRecords()) {
      if (Auth::user()->cant('index', Record::class)) {
        abort(403, 'This action is unauthorized');
      }
      $records = Record::where('patient_id', $id)->orderBy('created_at', 'DESC')->paginate();
      return view('crud.records.index', compact('records'));
    } else {
      return redirect()->route('profile.patient', $id)->withErrors([
        'error' => 'This user has no records.'
      ]);
    }
  }

  public function myRecords() {
    return $this->index(Auth::user()->id);
  }

  public function create($pid) {
    if (Auth::user()->cant('create', Record::class)) {
      abort(403, 'This action is unauthorized.');
    }

    $user = User::where('id', $pid)->get(['id', 'nid', 'name'])->first();
    $latrec = Record::where('patient_id', $pid)->orderBy('created_at', 'DESC')->first();

    return view('crud.records.create', compact('user', 'latrec'));
  }

  public function store(RecordRequest $request) {
    if (Auth::user()->cant('create', Record::class)) {
      abort(403, 'This action is unauthorized');
    }

    $record = Record::create($request->all());
    $vital = Vital::create(array_merge(['record_id' => $record->id], $request->toArray()));

    $this->saveFiles($request->file('file'), $record);

    return redirect()->route('profile.patient', $record->patient_id)->with([
      'info' => 'Record created successfully.'
    ]);
  }

  public function show($pid, $rid) {
    $record = Record::where('id', $rid)->where('patient_id', $pid)->first();

    if (!$record) {
      abort(404, 'Record not found.');
    }

    if (Auth::user()->cant('view', $record)) {
      abort(403, 'This action is unauthorized');
    }

    try {
      $vitals = Vital::where('record_id', $record->id)->first();
      $media = Medium::where('record_id', $record->id)->get();
      return view('crud.records.show', compact('record', 'media', 'vitals'));
    } catch (\Exception $e) {
      abort(404, $e);
    }
  }

  public function edit(Record $record) {
    if (Auth::user()->cant('update', $record)) {
      abort(403, 'This action is unauthorized');
    }

    $vitals = Vital::where('record_id', $record->id)->first();
    $media = Medium::where('record_id', $record->id)->get();
    return view('crud.records.edit', compact('record', 'media', 'vitals'));
  }

  public function update(RecordRequest $request, Record $record) {
    if (Auth::user()->cant('update', $record)) {
      abort(403, 'This action is unauthorized');
    }

    $record->prescription = $request->prescription;
    $record->description = $request->description;
    $record->diagnosis = $request->diagnosis;
    $record->save();

    $vitals = $record->vitals;
    $vitals->pulse = $request->pulse;
    $vitals->bpsystolic = $request->bpsystolic;
    $vitals->bpdiastolic = $request->bpdiastolic;
    $vitals->temperature = $request->temperature;
    $vitals->weight = $request->weight;
    $vitals->height = $request->height;
    $vitals->save();

    $this->saveFiles($request->file('file'), $record);

    return redirect()->route('records.show', [$record->patient_id, $record->id])->with([
      'info' => 'Record updated successfully.',
    ]);
  }

  function saveFiles($files, $record){
    if (!empty($files)) {
      $id = $record->patient_id;
      $list = Storage::files('patients/'.$id);
      foreach ($files as $item) {
        $name = $item->getClientOriginalName();
        if (in_array('patients/'.$id.'/'.$name, $list)) {
          $filename = Storage::putFileAs('patients/'.$id, new File($item->path()), '1 '.$name);
        } else {
          $filename = Storage::putFileAs('patients/'.$id, new File($item->path()), $name);
        }
        if ($filename) {
          Medium::create([
            'record_id' => $record->id,
            'path' => $item->getClientOriginalName(),
            'mime' => $item->getClientMimeType(),
          ]);
        }
      };
    }
  }

  public function destroy(Record $record) {
    if (Auth::user()->cant('delete', $record)) {
      abort(403, 'This action is unauthorized');
    }

    foreach ($record->media()->get() as $item) {
      if ($item->vanish()) {
        $item->delete();
      }
    }
    $record->delete();
    return redirect()->route('records.index', $record->patient_id)->with([
      'info' => 'Record deleted.',
    ]);
  }
}
