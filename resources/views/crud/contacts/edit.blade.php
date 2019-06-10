@extends('layouts.level2.cred')

@section('title')
Modify contact info
@endsection

@section('details')
  <form class="" action="{{ route('contacts.update', $contact->user_id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT"/>
    <input type="hidden" name="user_id" value="{{ $contact->user_id }}"/>
    <label>User: {{ CEM\User::find($contact->user_id)->name }}</label>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input class="form-control" type="text" name="phone" value="{{ $contact->phone }}"/>
    </div>
    <div class="form-group">
      <label for="mobile">Mobile</label>
      <input class="form-control" type="text" name="mobile" value="{{ $contact->mobile }}"/>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input class="form-control" type="text" name="address" value="{{ $contact->address }}"/>
    </div>
    <div class="form-group">
      <label for="city">City</label>
      <input class="form-control" type="text" name="city" value="{{ $contact->city }}"/>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('profile.patient', $contact->user_id) }}">Cancel</a>
    </div>
  </form>
@endsection
