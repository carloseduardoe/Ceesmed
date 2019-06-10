@extends('layouts.base')

@section('body')
  @include('layouts.partials.navigation')

  @yield('content')

  @include('layouts.partials.footer')
  
  @yield('javascript')
@endsection
