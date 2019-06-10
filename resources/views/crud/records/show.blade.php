@extends('layouts.level2.show')

@section('title')
Record details
@endsection

@section('header')
  <legend class="pb-3">{{ CEM\User::find($record->patient_id)->name }}<a class="btn btn-sm btn-link text-right" href="{{ route('profile.patient', $record->patient_id) }}">profile</a></legend>
@endsection

@section('details')
  <h6>Record Data</h6>
  <div class="row w-100 pb-3">
    <div class="col-4 text-right">Date</div>
    <div class="col-8">{{ Carbon\Carbon::parse($record->created_at)->format('F j\\, Y') }}</div>
    <div class="col-4 text-right">Description</div>
    <div class="col-8">{{ $record->description }}</div>
    <div class="col-4 text-right">Diagnosis</div>
    <div class="col-8">{{ $record->diagnosis }}</div>
    <div class="col-4 text-right">Prescription</div>
    <div class="col-8">{{ $record->prescription }}</div>
  </div>

  <h6>Vital Signs</h6>
  <div class="row w-100 pb-3">
    <div class="col-4 text-right">Pulse</div>
    <div class="col-8">{{ $vitals->pulse }} bpm</div>
    <div class="col-4 text-right">Temperature</div>
    <div class="col-8">{{ $vitals->temperature }} °C</div>
    <div class="col-4 text-right">Systolic pressure</div>
    <div class="col-8">{{ $vitals->bpsystolic }} mm Hg</div>
    <div class="col-4 text-right">Diastolic pressure</div>
    <div class="col-8">{{ $vitals->bpdiastolic }} mm Hg</div>
    <div class="col-4 text-right">Height</div>
    <div class="col-8">{{ $vitals->weight }} cm</div>
    <div class="col-4 text-right">Weight</div>
    <div class="col-8">{{ $vitals->height }} kg</div>
  </div>

  @if (count($media))
    <h6>Media files</h6>
    <div class="w-100">
      <table class="table table-sm">
        <thead class="">
          <tr>
            <th colspan="2">Filename</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($media as $medium)
            <tr>
              <td>{{ $medium->path }}</td>
              <td class="text-right">
                <a class="btn btn-sm" href="{{ route('media.show', $medium->id) }}">View</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
@endsection

@section('footer')
  <a class="btn btn-sm btn-primary text-right" href="{{ route('records.edit', $record->id) }}">Update</a>
  <form class="d-inline-block" action="{{ route('records.destroy', $record->id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE"/>
    <button class="btn btn-sm btn-danger" type="submit" name="button">Delete</button>
  </form>
@endsection
