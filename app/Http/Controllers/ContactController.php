<?php

namespace CEM\Http\Controllers;

use Carbon\Carbon;
use CEM\Contact;
use CEM\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use CEM\Http\Requests\ContactRequest;

class ContactController extends Controller
{
  public function index() {
    if (Auth::user()->cant('index', Contact::class)) {
      abort(403, 'This action is unauthorized.');
    }
    $contacts = Contact::paginate();
    return view('crud.contacts.index', compact('contacts'));
  }

  public function today() {
    if (Auth::user()->isJustPatient()) {
      abort(403, 'This action is unauthorized.');
    }

    $contacts = DB::table('contacts')
    ->join('appointments', function($join){
      $join->on('contacts.user_id', '=', 'appointments.patient_id');
    })
    ->whereBetween(
      'appointments.time',
      [Carbon::today()->toDateString(),
      Carbon::tomorrow()->toDateString()]
    )
    ->orderBy('appointments.time', 'DESC')
    ->select('contacts.user_id')->distinct()
    ->get()->toArray();

    foreach ($contacts as $item) {
      $item->name = User::find($item->user_id)->name;
    }

    return response()->json($contacts);
  }

  public function show(Contact $contact) {
    if (Auth::user()->cant('view', $contact)) {
      abort(403, 'This action is unauthorized.');
    }
    return view('crud.contacts.show', compact('contact'));
  }

  public function edit(Contact $contact) {
    if (Auth::user()->cant('update', $contact)) {
      abort(403, 'This action is unauthorized.');
    }
    $users = User::where('active', true)->get(['id','name']);
    return view('crud.contacts.edit', compact('contact', 'users'));
  }

  public function update(ContactRequest $request, Contact $contact) {
    if (Auth::user()->cant('update', $contact)) {
      abort(403, 'This action is unauthorized.');
    }
    $contact->phone = $request->phone;
    $contact->mobile = $request->mobile;
    $contact->address = $request->address;
    $contact->city = $request->city;
    $contact->save();

    return redirect()->route('profile.patient', $contact->user_id)->with([
      'info' => 'Contact Information Updated',
    ]);
  }
}
