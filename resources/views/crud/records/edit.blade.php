@extends('layouts.level2.cred')

@section('title')
Update record
@endsection

@section('details')
  <form id="updfrm" action="{{ route('records.update', $record->id) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <legend>Patient: {{ CEM\User::find($record->patient_id)->name }}</legend>
    <p>Record Date: {{ $record->created_at->format('F j\\, Y') }}</p>
    <fieldset id="vitals">
      <legend>Vital Signs</legend>
      <div class="form-group row">
        <div class="col">
          <label for="pulse">Pulse (bpm)</label>
          <input class="form-control" type="text" name="pulse" value="{{ $vitals->pulse }}"/>
        </div>
        <div class="col">
          <label for="temperature">Temperature (°C)</label>
          <input class="form-control" type="text" name="temperature" value="{{ $vitals->pulse }}"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col">
          <label for="bpsystolic">Systolic pressure (mm Hg)</label>
          <input class="form-control" type="text" name="bpsystolic" value="{{ $vitals->bpsystolic }}"/>
        </div>
        <div class="col">
          <label for="bpdiastolic">Diastolic pressure (mm Hg)</label>
          <input class="form-control" type="text" name="bpdiastolic" value="{{ $vitals->bpdiastolic }}"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col">
          <label for="height">Height (cm)</label>
          <input class="form-control" type="text" name="height" value="{{ $vitals->height }}"/>
        </div>
        <div class="col">
          <label for="weight">Weight (kg)</label>
          <input class="form-control" type="text" name="weight" value="{{ $vitals->weight }}"/>
        </div>
      </div>
    </fieldset>
    <fieldset id="record">
      <legend>Record data</legend>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" rows="6" name="description">{{ $record->description }}</textarea>
      </div>
      <div class="form-group">
        <label for="diagnosis">Diagnosis</label>
        <textarea class="form-control" rows="6" name="diagnosis">{{ $record->diagnosis }}</textarea>
      </div>
      <div class="form-group">
        <label for="prescription">Prescription</label>
        <textarea class="form-control" rows="6" name="prescription">{{ $record->prescription }}</textarea>
      </div>
    </fieldset>
    <fieldset id="media">
      <legend class="">Media Files</legend>
      <div class="form-group">
        <div class="custom-file w-100">
          <input class="custom-file-input" id="file" name="file[]" type="file" multiple>
          <label class="custom-file-label" for="file" id="fileLabel">Add files...</label>
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
  </form>
  @if (count($media))
    <div class="w-100">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th>Filename</th>
            <th colspan="2">Type</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($media as $medium)
            <tr>
              <td>{{ $medium->path }}</td>
              <td>{{ $medium->mime }}</td>
              <td class="text-right">
                <a class="btn btn-sm" href="{{ route('media.show', $medium->id) }}">View</a>
                <form class="d-inline-block" action="{{ route('media.destroy', $medium->id) }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE"/>
                  <button type="submit" class="btn btn-sm btn-link text-danger">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
  <div class="form-group">
    <button class="btn btn-primary" type="submit" onclick="updfrm.submit()">Save</button>
    <a class="btn btn-primary" href="{{ route('records.show', [$record->patient_id, $record->id]) }}">Cancel</a>
  </div>
@endsection
