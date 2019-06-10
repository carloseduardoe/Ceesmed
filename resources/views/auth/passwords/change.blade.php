@extends('layouts.auth')

@section('details')
  <div class="row py-2 justify-content-center">
    <h4 class="h4">Change Password</h4>
  </div>
  <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
    {{ csrf_field() }}
    <div class="form-row">
      <div class="col-12 mb-3">
        <label for="current">Current password</label>
        <input id="current" type="password" class="form-control{{ $errors->has('current') ? ' is-invalid' : '' }}" name="current" required>
      </div>

      <div class="col-12 mb-3">
        <label for="new">New password</label>
        <input type="password" class="form-control{{ $errors->has('new') ? ' is-invalid' : '' }}" id="new" name="new" required>
      </div>

      <div class="col-12 mb-3">
        <label for="new-confirm">Confirm new password</label>
        <input type="password" class="form-control{{ $errors->has('new_confirmation') ? ' is-invalid' : '' }}" id="new-confirm" name="new_confirmation" required>
      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary w-100">Save</button>
    </div>
  </form>
@endsection
