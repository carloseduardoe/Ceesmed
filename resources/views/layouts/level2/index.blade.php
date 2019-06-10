@extends('layouts.level1.main')

@section('content')
  <div class="row align-items-center">
    <div class="col">
      <h1 class="display-4">@yield('title')</h1>
    </div>
    <div class="col">
      @yield('action')
    </div>
  </div>
  <br>
  <div class="row align-items-center">
    <table class="table table-hover table-responsive-md">
      <thead class="bg-light">
        @yield('table')
      </tbody>
    </table>
  </div>
  <div class="row align-items-center justify-content-center">
    @yield('pagination')
  </div>
@endsection
