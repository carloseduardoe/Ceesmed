@extends('layouts.auth')

@section('details')
  <div class="row py-2 mb-2 justify-content-center">
    <h4 class="h4">Suspend Account</h4>
  </div>

  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <form class="form-horizontal" method="POST" action="{{ route('users.destroy', $user->id) }}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE"/>
    <input type="hidden" name="user_id" value="{{ $user->id }}"/>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label class="text-center" for="email">
        Type the user's e-Mail to continue.<wbr>
        <small class="btn btn-sm bg-light text-secondary">{{ $user->email }}</small>
      </label>
      <input id="email" type="email" class="form-control{{ $errors->has('email') ? " is-invalid" : "" }}" name="email" value="{{ old('email') }}" required>
      @if ($errors->has('email'))
        <div class="invalid-feedback">
          {{ $errors->first('email') }}
        </div>
      @endif
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-danger">Suspend</button>
    </div>
  </form>
@endsection
