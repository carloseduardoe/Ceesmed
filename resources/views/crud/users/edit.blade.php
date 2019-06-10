@extends('layouts.level2.cred')

@section('title')
Modify user info
@endsection

@section('details')
  <form action="{{ route('users.update', $user->id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT"/>
    <div class="form-group">
      <label for="nid">ID Number</label>
      <input class="form-control" type="text" name="nid" value="{{ $user->nid }}"/>
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" value="{{ $user->name }}"/>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="text" name="email" value="{{ $user->email }}"/>
    </div>
    @if (Auth::user()->hasRole(['admin', 'doctor']))
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="active" name="active" {{ $user->active ? "checked" : ""}}/>
          <label class="form-check-label" for="active">Active</label>
        </div>
      </div>
    @endif
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('profile.patient', $user->id) }}">Cancel</a>
    </div>
  </form>
@endsection
