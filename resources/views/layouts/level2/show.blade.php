@extends('layouts.level1.main')

@section('content')
  <div class="row align-items-start justify-content-around">
    <div class="col-12">
      <h4 class="h4">@yield('title')</h4>
      <hr>
    </div>
    <div class="col-sm-6 col-md-6">
      @yield('header')
    </div>
  </div>

  <div class="row align-items-start justify-content-around">
    <div class="col-6">
      @yield('details')
    </div>
  </div>

  <div class="row align-items-center justify-content-around">
    <div class="col-6">
      @yield('footer')
    </div>
  </div>
@endsection
