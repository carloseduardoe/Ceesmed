@extends('layouts.level1.main')

@section('content')
  <div class="row align-items-start justify-content-center">
    <div class="col-12 text-center">
      <h3 class="h3">@yield('title')</h3>
    </div>
    <div class="col-8">
      @yield('details')
    </div>
  </div>
@endsection
