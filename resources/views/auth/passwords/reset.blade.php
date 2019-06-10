@extends('layouts.auth')

@section('details')
  <div class="row py-2 justify-content-center">
    <h4 class="h4">Reset Password</h4>
  </div>
  <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
    {{ csrf_field() }}
    
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email">E-Mail Address</label>
      <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
      @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
      <label for="password">Password</label>
      <input id="password" type="password" class="form-control" name="password" required>
      @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
      <label for="password-confirm">Confirm Password</label>
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
      @if ($errors->has('password_confirmation'))
        <span class="help-block">
          <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group">
      <div class="form-check pl-0">
        <input class="form-check-check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
        <label class="form-check-label" for="remember">Remember Me</label>
      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary w-100">Change</button>
    </div>
  </form>
  <div class="row pt-1 justify-content-between">
    <a class="btn btn-link" href="{{ route('register') }}">Register instead?</a>
    <a class="btn btn-link" href="{{ route('password.request') }}">Send email again?</a>
  </div>
@endsection
