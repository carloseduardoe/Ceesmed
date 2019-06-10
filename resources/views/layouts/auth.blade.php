@extends('layouts.level1.plain')

@section('content')
  <div class="col-sm-6 col-md-5 col-lg-4">
    <div class="card">
      <div class="card-body">
        @yield('details')
      </div>
    </div>
  </div>
@endsection
