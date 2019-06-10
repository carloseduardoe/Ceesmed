<nav class="d-print-none navbar navbar-expand-md fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('externals.welcome') }}">
    <img src="{{ asset('brand/logo.png') }}" width="30" height="30" alt=""/>
    {{ env('APP_NAME') }}
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsDefault">
    @guest
      @include('layouts.partials.navigation.guestmenu')
    @else
      @include('layouts.partials.navigation.usermenu')
    @endguest
  </div>
</nav>
