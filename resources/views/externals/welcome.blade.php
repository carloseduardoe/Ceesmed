@extends('externals')

@section('content')
  <main role="main" class="welcome-main row w-100 mx-0 align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h1 class="display-4">Centro de Especialidades Médicas</h1>
        </div>
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-3 text-center">
              <h4 class="h4"><a class="lead text-muted" href="{{ route('externals.contact') }}">Contact</a></h4>
            </div>
            <div class="col-3 text-center">
              <h4 class="h4"><a class="lead text-muted" href="{{ route('externals.locate') }}">Location</a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
