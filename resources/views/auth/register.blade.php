@extends('layouts.auth')

@section('details')
  <div class="row py-2 justify-content-center">
    <h4 class="h4">Register</h4>
  </div>
  <form action="{{ route('register') }}" method="POST">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name" class="control-label">Name</label>
      <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>
    </div>

    <div class="form-group">
      <label for="nid" class="control-label">ID Number</label>
      <input id="nid" name="nid" type="text" class="form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" value="{{ old('nid') }}" required>
    </div>

    <div class="form-group">
      <label for="email" class="control-label">E-Mail Address</label>
      <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
      <label for="password" class="control-label">Password</label>
      <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
    </div>

    <div class="form-group">
      <label for="password-confirm" class="control-label">Confirm Password</label>
      <input id="password-confirm" name="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" required>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </div>
  </form>

  <div class="row justify-content-around">
    <a class="btn btn-link" href="{{ route('login') }}">Login instead?</a>
  </div>
@endsection
