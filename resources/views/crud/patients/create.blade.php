@extends('layouts.level2.cred')

@section('title')
New Patient
@endsection

@section('details')
  <form action="{{ route('patients.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old("name") }}" class="form-control{{ $errors->has("name") ? ' is-invalid' : '' }}" type="text" required autofocus>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="nid">ID</label>
        <input id="nid" name="nid" value="{{ old("nid") }}" class="form-control{{ $errors->has("nid") ? ' is-invalid' : '' }}" type="text">
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="email">Email</label>
        <input id="email" name="email" value="{{ old("email") }}" placeholder="{{ 'patient@'.env('APP_URL') }}" class="form-control{{ $errors->has("email") ? ' is-invalid' : '' }}" type="email">
      </div>
      <hr>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="birthdate">Date of birth</label>
        <input id="birthdate" name="birthdate" value="{{ old("birthdate") }}" class="form-control" type="date" required/>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="gender">Gender</label>
        <select class="form-control" name="gender" required>
          <option class="d-none"></option>
          @foreach ([
            'm' => 'male', 'f' => 'female', '*' => 'unknown'
          ] as $key => $value)
            <option value="{{ $key }}" {!! $key == old('gender') ? "selected" : "" !!}>{!! $value !!}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="bloodtype">Bloodtype</label>
        <select class="form-control" name="bloodtype">
          <option class="d-none"></option>
          @foreach ([
            'A +', 'A -', 'A *', 'B +', 'B -', 'B *',
            'AB+', 'AB-', 'AB*', 'O +', 'O -', 'O *',
            '*',
          ] as $item)
            <option value="{{ $item }}" {!! $item == old("bloodtype") ? "selected" : "" !!}>{{ $item }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12">
        <label for="notes">Background</label>
        <textarea id="notes" name="notes" class="form-control{{ $errors->has("notes") ? ' is-invalid' : '' }}" rows="8" cols="80">{{
          old("notes") ?: "Pathological History:\r\n\r\nAlergies:\r\n\r\nVaccines:\r\n\r\nOther:"
        }}</textarea>
      </div>
      <hr>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="phone">Phone</label>
        <input id="phone" name="phone" value="{{ old('phone') }}" class="form-control" type="text"/>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="mobile">Mobile</label>
        <input id="mobile" name="mobile" value="{{ old('mobile') }}" class="form-control" type="text"/>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="address">Address</label>
        <input id="address" name="address" value="{{ old('address') }}" class="form-control" type="text"/>
      </div>
      <div class="form-group col-12 col-sm-12 col-md-6">
        <label for="city">City</label>
        <input id="city" name="city" value="{{ old('city') ?: 'Quito' }}" class="form-control" type="text"/>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ url()->previous() }}">Cancel</a>
    </div>
  </form>
@endsection
