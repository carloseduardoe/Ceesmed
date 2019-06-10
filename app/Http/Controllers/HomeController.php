<?php

namespace CEM\Http\Controllers;

use Carbon\Carbon;

use CEM\User;
use CEM\Catalog;
use CEM\Mail\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use CEM\Http\Requests\ReachRequest;

class HomeController extends Controller
{
  public function index($choice = 'patient'){
    if (Auth::check() && in_array($choice, ['admin', 'agent', 'doctor', 'patient']) && Route::currentRouteName() != 'externals.welcome') {
      if (Auth::user()->hasRole([$choice])) {
        if ($choice == 'doctor') {
          $links = Catalog::where('key', 'like', 'doctorlink%')->get();
          return view('dashboards.doctor', compact('links'));
        } else {
          return view('dashboards.'.$choice);
        }
      } else {
        return view('dashboards.'.Auth::user()->roles()->first()->name);
      }
    } else {
      return $this->welcome();
    }
  }

  public function welcome() {
    return view('externals.welcome');
  }

  public function contact() {
    return view('externals.contact');
  }

  public function reach(ReachRequest $request) {
    Mail::to(env('ADMIN_EMAIL'))->send(new Message([
      'header' => 'Message from '.$request->name,
      'body'   => $request->message."\n email: ".$request->email." phone: ".$request->phone,
    ], 'Message from '.$request->name));
    return redirect()->route('home')->with([
      'info' => 'Message sent!'
    ]);
  }

  public function locate() {
    return view('externals.locate');
  }

  public function write($did = -1) {
    if (Auth::user()->isJustPatient()) {
      abort(403, 'This action is unauthorized');
    }

    $data = [
      'title'     => "Centro de Especialidades Médicas",
      'header'    => Carbon::now()->formatLocalized('%A, %B %d of %Y'),
      'body'      => "",
      'signature' => "Regards,",
    ];

    $intro = "The purpose of this document is to certify that PATIENT'S_NAME with ID# ID_NUMBER, has undergone a medical examination.";

    switch ($did) {
      case 0:
        $data['title'] = "Certificate of Attendance";
        $data['body']  = $intro."\r\n\r\nThe examiner has found PATIENT'S_CONDITION and has advised that PATIENT'S_PRESCRIPTION.";
        break;
      case 1:
        $data['title'] = "Health Certificate";
        $data['body']  = $intro."\r\n\r\nThe examiner has not found any adverse health conditions or contraindications for DESIRED_DOCUMENT_PURPOSE";
        break;
      case 2:
        $data['title'] = "Medical Certificate";
        $data['body']  = $intro."\r\n\r\nThe examiner has found the following health conditions:\r\n- Condition\r\n- Condition\r\n- Condition";
        break;
      case 3:
        $data['title'] = "Medical Prescription";
        break;
      default:
        $data['header'] .= "\r\n\r\n\r\nTo whom it may concern,";
        break;
    }

    return view('helpers.write', compact('data'));
  }

  public function print(Request $request) {
    if (Auth::user()->isJustPatient()) {
      abort(403, 'This action is unauthorized');
    }

    return view('helpers.print')->with([
      'data' => $request->all()
    ]);
  }

  public function editCatalog() {
    if (Auth::user()->hasRole(['admin'])) {
      $catalogs = Catalog::all();
      return view('crud.catalogs.edit', compact('catalogs'));
    } else {
      abort(403, 'This action is unauthorized.');
    }
  }

  public function updateCatalog(Request $request) {
    if (Auth::user()->hasRole(['admin'])) {
      foreach ($request->all() as $key => $value) {
        if (substr($key, 0, 1) != "_") {
          $item = Catalog::where('key', 'like', $key.'%')->first();
          $item->value = $value;
          $item->save();
        }
      }
      return redirect()->route('home', 'admin')->with([
        'info' => 'Doctor links updated successfully.',
      ]);
    } else {
      abort(403, 'This action is unauthorized.');
    }
  }
}
