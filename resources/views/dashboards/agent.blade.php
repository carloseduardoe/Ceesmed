@extends('layouts.level1.main')

@section('content')
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">Hello, {{ Auth::user()->name }}</h1>
    </div>
  </div>
  <div class="row pb-3">
    <div class="col-12">
      <h2 class="">Agent Dashboard</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h4 class="font-weight-light">Today's Appointments</h4>
      <div class="list-group list-group-flush pb-2" id="todayList">
        <small class="border-0 mb-2">No appointments scheduled for today.</small>
      </div>
      <p><a class="btn btn-primary" href="{{ route('appointments.index') }}" role="button">View all</a></p>
    </div>
    <div class="col-md-4">
      <h4 class="font-weight-light">Today's Patients</h4>
      <div class="list-group list-group-flush pb-2" id="todaysContacts">
        <small class="border-0 mb-2">No relevant contacts found for today.</small>
      </div>
      <p><a class="btn btn-primary" href="{{ route('contacts.index') }}" role="button">View all</a></p>
    </div>
    <div class="col-md-4">
      <h4 class="font-weight-light">Doctor Schedules</h4>
      <small class="d-block mb-3">Check the availability of your doctors.</small>
      <p><a class="btn btn-primary" href="{{ route('schedules.index') }}" role="button">Go</a></p>
    </div>
    <div class="col-md-4">
      <h4 class="font-weight-light">Documents</h4>
      <small class="d-block mb-3">Compose a document.</small>
      <p><a class="btn btn-primary" href="{{ route('home.write') }}" role="button">Go</a></p>
    </div>
  </div>
  <script type="text/javascript">
    try {
      window.$ = window.jQuery;
      window.onload = function() {
        $.ajax({
          url: "{!! route('appointments.today', 'x') !!}",
          dataType: 'json',
          success: function(data) {
            if (data.length > 0) {
              var list = document.getElementById('todayList');
              while (list.childNodes[0]) {
                list.removeChild(list.childNodes[0]);
              }
              data.map((item, i) => {
                var link = document.createElement('a');
                link.href = "../appointments/" + item.id;
                link.className = "list-group-item" + (i == 0 ? " border-0" : "");
                var date = new Date(item.time);
                link.appendChild(document.createTextNode(date.getHours() + ":" + (date.getMinutes()<10?'0':'') + date.getMinutes() + " " + item.doctor + " - " + item.type));
                list.appendChild(link);
              });
            }
          }
        });

        $.ajax({
          url: "{!! route('contacts.today') !!}",
          dataType: 'json',
          success: function(data) {
            if (data.length > 0) {
              var clist = document.getElementById('todaysContacts');
              while (clist.childNodes[0]) {
                clist.removeChild(clist.childNodes[0]);
              }
              data.map((item, i) => {
                var link = document.createElement('a');
                link.href = "../patient/" + item.user_id;
                link.className = "list-group-item" + (i == 0 ? " border-0" : "");
                link.appendChild(document.createTextNode(item.name));
                clist.appendChild(link);
              });
            }
          }
        });
      };
    } catch (e) {
      console.error(e);
    }
  </script>
@endsection
