@extends('layouts.base')

@section('body')
  @include('layouts.partials.navigation')
  <main role="main">
    <div class="container">
      @include('layouts.partials.errors')
      @include('layouts.partials.info')
      <div class="row w-100 justify-content-center px-1 mx-0">
        @yield('content')
      </div>
    </div>
  </main>

  @include('layouts.partials.footer')
  @yield('javascript')
@endsection
