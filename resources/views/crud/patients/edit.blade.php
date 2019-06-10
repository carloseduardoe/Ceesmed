@extends('layouts.level2.cred')

@section('title')
Update patient info
@endsection

@section('details')
  <form class="" action="{{ route('patients.update', $patient->user_id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT"/>
    <input type="hidden" name="user_id" value="{{ $patient->user_id }}"/>
    <label>User: {{ CEM\User::find($patient->user_id)->name }}</label>
    <div class="form-group">
      <label for="birthdate">Date of birth</label>
      <input class="form-control" type="date" name="birthdate"
        value="{{ $patient->birthdate }}"
        required/>
    </div>

    <div class="form-group">
      <label for="gender">Gender</label>
      <select class="form-control" name="gender">
        @foreach ([
          'm' => 'male', 'f' => 'female', '*' => 'unknown'
        ] as $key => $value)
          <option value="{{ $key }}" {!! $key == $patient->gender ? "selected" : "" !!}>{!! $value !!}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="bloodtype">Bloodtype</label>
      <select class="form-control" name="bloodtype">
        @foreach ([
          'A +', 'A -', 'A *', 'B +', 'B -', 'B *',
          'AB+', 'AB-', 'AB*', 'O +', 'O -', 'O *',
          '*',
        ] as $item)
          <option value="{{ $item }}" {!! $item == $patient->bloodtype ? "selected" : "" !!}>
            {{ $item }}
          </option>
        @endforeach
      </select>
    </div>

    @if (Auth::user()->hasRole(['admin', 'doctor']))
      <div class="form-group">
        <label for="notes">Anamnesis</label>
        <textarea class="form-control" name="notes" rows="8" cols="80">{{ $patient->notes }}</textarea>
      </div>
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="viewhistory" name="viewhistory" {{ $patient->viewhistory ? "checked" : ""}}>
          <label class="form-check-label" for="viewhistory">History Enabled</label>
        </div>
      </div>
    @endif

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('profile.patient', $patient->id) }}">Cancel</a>
    </div>
  </form>
@endsection
