@extends('layouts.level2.cred')

@section('title')
Create schedule
@endsection

@section('details')
  <form class="" action="{{ route('schedules.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="doctor_id">Doctor</label>
      <select class="form-control" name="doctor_id">
        <option class="d-none"></option>
        @foreach ($doctors as $item)
          <option value="{{ $item->id }}" {{ old('doctor_id') == $item->id ? "selected" : "" }}>
            {{ $item->name }} - {{ $item->specialty }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="day">Day</label>
      <select class="form-control" name="day">
        <option class="d-none"></option>
        @foreach ([
          'mon' => "Monday",
          'tue' => "Tuesday",
          'wed' => "Wednesday",
          'thu' => "Thursday",
          'fri' => "Friday",
          'sat' => "Saturday",
          'sun' => "Sunday",
        ] as $key => $value)
          <option value="{{ $key }}" {{ old('day') == $key ? "selected" : "" }}>
            {{ $value }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="start">Start</label>
      <input class="form-control" type="time" name="start" value="{{ old('start') }}"/>
    </div>
    <div class="form-group">
      <label for="end">End</label>
      <input class="form-control" type="time" name="end" value="{{ old('end') }}"/>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('schedules.index') }}">Cancel</a>
    </div>
  </form>
@endsection
