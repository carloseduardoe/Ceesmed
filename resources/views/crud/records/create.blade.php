@extends('layouts.level2.cred')

@section('title')
New Record<br/>
<small>{{ Carbon\Carbon::now()->format('F j\\, Y') }}</small>
@endsection

@section('details')
  <form action="{{ route('records.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <hr>
    <fieldset id="patient">
      <legend class="w-100">{{ $user->name }}</legend>
      <div class="form-group pt-1 row">
        <div class="col-12">
          <input class="form-control" type="hidden" name="patient_id" value="{{ old('patient_id') ? old('patient_id') : $user->id }}"/>
        </div>
        <div class="col-4 col-md-2 text-md-right">Birthdate</div>
        <div class="col-8 col-md-10">{{ Carbon\Carbon::parse($user->patient->birthdate)->format('F j\\, Y') }}</div>
        <div class="col-4 col-md-2 text-md-right">Age</div>
        <div class="col-8 col-md-10">{{ Carbon\Carbon::parse($user->patient->birthdate)->diff(Carbon\Carbon::now())->format('%y years, %m months') }}</div>
        @if ($user->patient->notes)
          <div class="col-4 col-md-2 text-md-right">Background</div>
          <div class="col-8 col-md-10" style="white-space: pre-wrap;">{{ $user->patient->notes }}</div>
        @endif
      </div>
      @if ($user->patient->hasRecords())
        <div class="form-group row pt-4">
          <h6 class="text-weight-light">Last Record ({{ $latrec->created_at->format('F j\\, Y') }})</h6>
          <div class="row">
            {{-- <div class="col-4 col-md-2 text-md-right">Anamnesis</div> --}}
            {{-- <div class="col-8 col-md-4" style="white-space: pre-wrap;">{{ $latrec->description }}</div> --}}
            <div class="col-4 col-md-2 text-md-right">Diagnosis</div>
            <div class="col-8 col-md-4" style="white-space: pre-wrap;">{{ $latrec->diagnosis }}</div>
            <div class="col-4 col-md-2 text-md-right">Prescription</div>
            <div class="col-8 col-md-4" style="white-space: pre-wrap;">{{ $latrec->prescription }}</div>
          </div>
        </div>
      @endif
    </fieldset>
    <hr>
    <h6 class="text-weight-light">Record data</h6>
    <div class="form-group">
      <label for="description">Anamnesis</label>
      <textarea class="form-control" name="description" rows="10">{{ old('description') ?: "Motivo de Consulta:\r\nEnfermedad Actual:\r\nExamen Físico:" }}</textarea>
    </div>
    <fieldset id="vitals">
      <div class="form-group row">
        <div class="col-6 col-sm-4">
          <label for="height">Height (cm)</label>
          <input class="form-control" type="text" name="height" value="{{ old('height') }}" required/>
        </div>
        <div class="col-6 col-sm-4">
          <label for="weight">Weight (kg)</label>
          <input class="form-control" type="text" name="weight" value="{{ old('weight') }}" required/>
        </div>
        <div class="col-6 col-sm-4">
          <label for="pulse">Pulse (bpm)</label>
          <input class="form-control" type="text" name="pulse" value="{{ old('pulse') }}"/>
        </div>
        <div class="col-6 col-sm-4">
          <label for="temperature">Temperature (°C)</label>
          <input class="form-control" type="text" name="temperature" value="{{ old('temperature') }}"/>
        </div>
        <div class="col-6 col-sm-4">
          <label for="bpsystolic">Systolic pressure (mm Hg)</label>
          <input class="form-control" type="text" name="bpsystolic" value="{{ old('bpsystolic') }}"/>
        </div>
        <div class="col-6 col-sm-4">
          <label for="bpdiastolic">Diastolic pressure (mm Hg)</label>
          <input class="form-control" type="text" name="bpdiastolic" value="{{ old('bpdiastolic') }}"/>
        </div>
      </div>
    </fieldset>
    <hr>
    <fieldset id="media">
      <div class="form-group">
        <h6 class="text-weight-light">Medical Tests</h6>
        <div class="custom-file w-100">
          <input class="custom-file-input" id="file" name="file[]" type="file" multiple>
          <label class="custom-file-label" for="file" id="fileLabel">Choose files...</label>
        </div>
      </div>
      <script type="text/javascript">
        document.getElementById('file').addEventListener('change', function(event){
          var label = document.getElementById('fileLabel');
          if (this.files.length == 1) {
            label.textContent = this.files[0].name;
          } else {
            label.textContent = this.files.length + " files selected...";
          }
        });
      </script>
    </fieldset>
    <fieldset id="record">
      <div class="form-group">
        <label for="diagnosis">Diagnosis</label>
        <textarea class="form-control" name="diagnosis" rows="4">{{ old('diagnosis') }}</textarea>
      </div>
      <div class="form-group">
        <label for="prescription">Prescription</label>
        <textarea class="form-control" name="prescription" rows="10">{{ old('prescription') }}</textarea>
      </div>
    </fieldset>
    <div class="form-group pt-3">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('home') }}">Cancel</a>
    </div>
  </form>
  <div class="bg-dark rounded mt-5">
    @include('layouts.partials.searchForm')
  </div>
@endsection
