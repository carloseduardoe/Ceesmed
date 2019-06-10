@extends('layouts.level2.cred')

@section('title')
Make an Appointment
@endsection

@section('details')
  <form action="{{ route('appointments.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="patient_id">Patient</label>
        <select class="form-control" name="patient_id">
          @if (count($patients) > 1)
            <option class="d-none"></option>
          @endif
          @foreach ($patients as $item)
            <option value="{{ $item->id }}" {{ old('patient_id') == $item->id ? 'selected' : '' }}>
              {{ $item->nid }} - {{ $item->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="doctor_id">Doctor</label>
        <select class="form-control" name="doctor_id" id="doctorSelector" onchange="getSchedules()">
          @if (count($doctors) > 1)
            <option class="d-none"></option>
          @endif
          @foreach ($doctors as $item)
            <option value="{{ $item->id }}" {{ old('doctor_id') == $item->id ? 'selected' : '' }}>
              {{ $item->specialty }} - {{ $item->name }}
            </option>
          @endforeach
        </select>

        <div id="scheduleDisplay">
          <p class="small mb-0 text-info">Please pick a specialist.</p>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="time">Date</label>
        <input class="form-control" type="date" name="time0" value="{{ old('time0') }}" required/>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="time">Time</label>
        <input class="form-control" type="time" name="time1" value="{{ old('time1') }}" required/>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="type">Type</label>
        <select class="form-control" name="type">
          @foreach (['check', 'consultation', 'therapy'] as $item)
            <option value="{{ $item }}" {{ old('type') == $item ? 'selected' : '' }}>
              {{ $item }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="reason">Reason</label>
      <textarea class="form-control" name="reason" rows="4" cols="80" maxlength="200">{{ old('reason') }}</textarea>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('appointments.index') }}">Cancel</a>
    </div>
  </form>
  @if (count($doctors) > 0)
    <script type="text/javascript">
      function getSchedules() {
        var selector = document.getElementById('doctorSelector');
        var body = document.getElementById('scheduleDisplay');
        body.innerHTML = "";
        $.ajax({
          url: "{{ url('') }}/schedules/" + selector.selectedOptions[0].value + "/1",
          dataType: 'json',
          success: function(data) {
            if (data.length > 0) {
              data.map((item, i) => {
                var par = document.createElement('p');
                par.className = "small mb-0 text-info";
                par.innerHTML = item.day + ": " + item.start.substring(0,5) + " - " + item.end.substring(0,5);
                body.appendChild(par);
              });
            } else {
              var par = document.createElement('p');
              par.className = "small mb-0 text-info";
              par.innerHTML = "This specialist has no schedules available.";
              body.appendChild(par);
            }
          }
        });
      }
      @if (count($doctors) == 1)
        getSchedules();
      @endif
    </script>
  @endif
@endsection
