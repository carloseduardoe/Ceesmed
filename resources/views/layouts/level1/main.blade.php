@extends('layouts.base')

@section('body')
  @include('layouts.partials.navigation')

  <main role="main">
    <div class="row w-100 pl-4 justify-content-center">
      @if (!Auth::user()->isJustPatient())
        <div class="d-print-none col-12 col-md-2">
          @include('layouts.partials.sidebar')
        </div>
      @endif
      <div class="col-12 col-sm-9 col-md-10 pl-4 container">
        @include('layouts.partials.errors')
        @include('layouts.partials.info')
        @yield('content')
      </div>
    </div>
  </main>

  @include('layouts.partials.footer')

  @yield('messages')
@endsection
