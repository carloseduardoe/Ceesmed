<ul class="navbar-nav ml-auto">
  <li class="nav-item {{ Route::currentRouteName() == "login" ? "active" : "" }}">
    <a class="nav-link" href="{{ route('login') }}">Login</a>
  </li>
  <li class="nav-item {{ Route::currentRouteName() == "register" ? "active" : "" }}">
    <a class="nav-link" href="{{ route('register') }}">Register</a>
  </li>
</ul>
