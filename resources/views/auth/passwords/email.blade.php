@extends('layouts.auth')

@section('details')
  <div class="row py-2 justify-content-center">
    <h4 class="h4">Reset Password</h4>
  </div>

  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email">E-Mail Address</label>
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
      @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Send Message</button>
    </div>
  </form>
@endsection
