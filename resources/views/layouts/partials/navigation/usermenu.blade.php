<ul class="navbar-nav mr-auto">
  @if (Auth::user()->isJustPatient())
    <li class="nav-item dropdown">
      <a class="nav-link" href="{{ route('home') }}"><i class="material-icons"></i> Home</a>
    </li>
  @else
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="" id="roledown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Role</a>
      <div class="dropdown-menu dropdown-menu-left" aria-labelledby="roledown">
        @if (Auth::user()->hasRole(['admin']))
          <a class="dropdown-item" href="{{ route('home', 'admin') }}">Admin</a>
        @endif
        @if (Auth::user()->hasRole(['agent']))
          <a class="dropdown-item" href="{{ route('home', 'agent') }}">Agent</a>
        @endif
        @if (Auth::user()->hasRole(['doctor']))
          <a class="dropdown-item" href="{{ route('home', 'doctor') }}">Doctor</a>
        @endif
        <a class="dropdown-item" href="{{ route('home') }}">Patient</a>
      </div>
    </li>
  @endif
  @foreach (['admin', 'agent', 'doctor'] as $value)
    @if (Auth::user()->hasRole([$value]))
      @include('layouts.partials.navigation.'.$value)
    @endif
  @endforeach
</ul>

<ul class="navbar-nav ml-auto">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="" id="accountdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="material-icons">person</i> {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountdown">
      <a class="dropdown-item" href="{{ route('doctors.my') }}">My doctors</a>
      <a class="dropdown-item" href="{{ route('appointments.my') }}">My appointments</a>
      <div class="dropdown-divider"></div>
      @if (Auth::user()->hasRole(['doctor']))
        <a class="dropdown-item" href="{{ route('profile.doctor') }}">Resume</a>
      @endif
      <a class="dropdown-item" href="{{ route('profile.patient') }}">Profile</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('password.change') }}">Change Password</a>
      <a class="dropdown-item" href=""
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">{{ csrf_field() }}</form>
    </div>
  </li>
</ul>
