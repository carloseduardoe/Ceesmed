@extends('layouts.level1.main')

@section('content')
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">Hello, Dr. {{ Auth::user()->name }}</h1>
    </div>
  </div>
  <div class="row pb-3">
    <div class="col-12">
      <h2>Doctor Dashboard</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h4 class="font-weight-light">Certificates</h4>
      <div class="list-group list-group-flush small pb-2">
        <a class="list-group-item border-0" href="{{ route('home.write') }}" role="button">Compose Document</a>
        <a class="list-group-item" href="{{ route('home.write', 0) }}" role="button">Certificate of Attendance</a>
        <a class="list-group-item" href="{{ route('home.write', 1) }}" role="button">Health Certificate</a>
        <a class="list-group-item" href="{{ route('home.write', 2) }}" role="button">Medical Certificate</a>
        <a class="list-group-item" href="{{ route('home.write', 3) }}" role="button">Write Prescription</a>
      </div>
    </div>
    <div class="col-md-4">
      <h4 class="font-weight-light">Today's Appointments</h4>
      <div class="list-group list-group-flush small pb-2" id="todayList">
        <p class="border-0 mb-2">No appointments scheduled for today</p>
      </div>
      <p><a class="btn btn-primary" href="{{ route('appointments.index', ['n', Auth::user()->id]) }}" role="button">View All</a></p>
    </div>
    <div class="col-md-4">
      <h4 class="font-weight-light">Useful Information</h4>
      <div class="list-group list-group-flush small">
        @for ($i=0; $i < count($links); $i++)
          @if ($i == 0)
            <a class="list-group-item border-0" href="{{ $links[$i]->value }}" role="button" target="_blank">{{ substr($links[$i]->key, 11) }}</a>
          @elseif ($i == count($links) - 1)
            <a class="border-bottom-0 list-group-item" href="{{ $links[$i]->value }}" role="button" target="_blank">{{ substr($links[$i]->key, 11) }}</a>
          @else
            <a class="list-group-item" href="{{ $links[$i]->value }}" role="button" target="_blank">{{ substr($links[$i]->key, 11) }}</a>
          @endif
        @endfor
      </div>
      @include('layouts.partials.searchForm')
    </div>
    <script type="text/javascript">
      try {
        window.$ = window.jQuery;
        window.onload = function() {
          $.ajax({
            url: "{!! route('appointments.today', Auth::user()->id) !!}",
            dataType: 'json',
            success: function(data) {
              if (data.length > 0) {
                var list = document.getElementById('todayList');
                list.removeChild(list.firstChild);
                data.map((item, i) => {
                  var link = document.createElement('a');
                  link.href = "appointments/" + item.id;
                  link.className = "list-group-item" + (i == 0 ? " border-0" : "");
                  link.appendChild(document.createTextNode((new Date(item.time)).toLocaleTimeString() + " " + item.type));
                  list.appendChild(link);
                });
              }
            }
          });
        };
      } catch (e) {
        console.error(e);
      }
    </script>
  </div>
@endsection
