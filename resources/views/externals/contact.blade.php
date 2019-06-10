@extends('externals')

@section('content')
  <div class="mb-auto h-10"></div>

  <main role="main">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-12 text-left text-sm-center">
          <h3>Centro de Especialidades Médicas</h3>
        </div>
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-10 col-md-6 col-lg-5">
              <form action="{{ route('externals.reach') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="name">Name</label>
                  <input name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" value="{{ old('name') }}" required autofocus/>
                  @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="email">E-Mail</label>
                  <input name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" value="{{ old('email') }}" required/>
                  @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" type="tel" value="{{ old('phone') }}" required/>
                  @if ($errors->has('phone'))
                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" rows="5" cols="80" required>{{ old('message') }}</textarea>
                  @if ($errors->has('message'))
                    <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Send</button>
                  <a class="btn btn-primary" href="{{ route('externals.welcome') }}">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div class="mt-auto h-25"></div>
@endsection
