@extends('layouts.level2.index')

@section('title')
  Medical History<br/><a class="small text-dark font-weight-light" href="{{ route('profile.patient', $records->first()->patient_id) }}">{{ CEM\User::find($records->first()->patient_id)->name }}</a>
@endsection

@section('action')
  @if (Auth::user()->can('create', Record::class))
    <a class="btn btn-primary float-right d-print-none" role="button" href="{{ route('records.create', $records->first()->patient_id) }}">Add record</a>
  @endif
@endsection

@section('table')
    <tr>
      @if (Auth::user()->isJustPatient())
        <th scope="col">Date</th>
        <th scope="col" colspan="2">Diagnosis</th>
      @else
        <th scope="col">Date</th>
        <th scope="col">Description</th>
        <th scope="col">Diagnosis</th>
        <th scope="col" colspan="2">Prescription</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @if (Auth::user()->isJustPatient())
      @foreach ($records as $item)
        <tr>
          <td>{{ Carbon\Carbon::parse($item->created_at)->format('F j\\, Y') }}</td>
          <td>{{ $item->diagnosis }}</td>
          <td class="p-0 align-middle text-right d-print-none">
            <a class="btn btn-sm" href="{{ route('records.show', [$item->patient_id, $item->id]) }}">View</a>
          </td>
        </tr>
      @endforeach
    @else
      @foreach ($records as $item)
        <tr>
          <td>{{ Carbon\Carbon::parse($item->created_at)->format('F j\\, Y') }}</td>
          <td>{{ $item->description }}</td>
          <td>{{ $item->diagnosis }}</td>
          <td>{{ $item->prescription }}</td>
          <td class="p-0 align-middle text-right d-print-none">
            <a class="btn btn-sm" href="{{ route('records.show', [$item->patient_id, $item->id]) }}">View</a>
            <a class="btn btn-sm" href="{{ route('records.edit', $item->id) }}">Update</a>
            <form action="{{ route('records.destroy', $item->id) }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE"/>
              <button class="btn btn-sm btn-link text-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    @endif
@endsection

@section('pagination')
  {!! $records->render() !!}
@endsection
