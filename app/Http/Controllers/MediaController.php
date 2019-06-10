<?php

namespace CEM\Http\Controllers;

use CEM\User;
use CEM\Record;
use CEM\Medium;
use Illuminate\Http\Request;
use CEM\Http\Requests\MediumRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
  public function show(Medium $medium) {
    if (Auth::user()->cant('view' ,$medium)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.media.show', compact('medium'));
  }

  public function deliver(Medium $medium) {
    if (Auth::user()->cant('view' ,$medium)) {
      abort(403, 'This action is unauthorized.');
    }
    return $medium->obtain();
  }

  public function destroy(Medium $medium) {
    if (Auth::user()->cant('delete' ,$medium)) {
      abort(403, 'This action is unauthorized.');
    }
    $info = 'File deleted.';
    if ($medium->vanish()) {
      $medium->delete();
      $info = 'File deleted.';
    }
    return redirect()->route('records.show', [Record::find($medium->record_id)->patient_id , $medium->record_id])->with([
      'info' => $info ? $info : 'Couldn\'t delete file.',
    ]);
  }
}
