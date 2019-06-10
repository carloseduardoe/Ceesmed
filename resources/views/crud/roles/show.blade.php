@extends('layouts.level2.show')

@section('title')
Contact info
@endsection

@section('header')
  <span><strong>{{ CEM\User::find($contact->user_id)->name }}</strong></span>
@endsection

@section('details')
  <p><strong>Phone:</strong> {{ $contact->phone }}</p>
  <p><strong>Mobile:</strong> {{ $contact->mobile }}</p>
  <p><strong>Address:</strong> {{ $contact->address }}</p>
  <p><strong>City:</strong> {{ $contact->city }}</p>
@endsection

@section('footer')
  <a class="btn btn-sm btn-primary" href="{{ route('contacts.edit', $contact->user_id) }}">Edit</a>
  <form class="d-inline-block" action="{{ route('contacts.destroy', $contact->user_id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE"/>
    <button class="btn btn-sm btn-danger" type="button" name="button">Delete</button>
  </form>
@endsection
