<?php

namespace CEM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseController extends Controller
{
  public function backup() {
    if (Auth::user()->hasRole(['admin'])) {
      Artisan::call('mysql:dump');
      $files = Storage::files('backups');
      return redirect()->route('home', 'admin')->with([
        'info' => 'Database backup performed successfully. <a href="'.route('databases.download').'" target="_blank">Download</a>',
      ]);
    } else {
      abort(403, 'This action is unauthorized.');
    }
  }

  public function getBackup() {
    if (Auth::user()->hasRole(['admin'])) {
      $files = Storage::files('backups');
      if (count($files) > 0) {
        return Storage::download($files[count($files) - 1]);
      } else {
        return redirect()->route('home', 'admin')->with([
          'error' => 'There is no backup available for download.',
        ]);
      }
    } else {
      abort(403, 'This action is unauthorized.');
    }
  }
}
