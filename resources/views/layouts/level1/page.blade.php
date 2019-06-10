@extends('layouts.base')

@section('body')
  @include('layouts.partials.navigation')
  <main role="main">
    <div class="w-100 px-1 container">
      @yield('content')
    </div>
  </main>

  @include('layouts.partials.footer')
  @yield('javascript')
@endsection
