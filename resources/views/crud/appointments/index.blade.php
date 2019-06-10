@extends('layouts.level2.index')

@section('title')
{{ Auth::user()->hasRole(['admin']) ? "" : "Upcoming " }}Appointments
@endsection

@section('action')
  <a class="btn btn-primary float-right d-print-none" role="button" href="{{ route('appointments.create') }}">Make Appointment</a>
@endsection

@section('table')
  @php
    $user = Auth::user();
  @endphp
    <tr>
      @if (!$user->isJustPatient())
        <th scope="col">Patient</th>
      @endif
      <th scope="col">Doctor</th>
      <th scope="col">Date & Time</th>
      <th scope="col">Type</th>
      <th scope="col" colspan="2">Reason</th>
    </tr>
  </thead>
  <tbody>
    @if ($user->isJustPatient())
      @foreach ($appointments as $item)
        <tr>
          <td>{{ CEM\User::find(CEM\Doctor::find($item->doctor_id)->user_id)->name }}</td>
          <td>{{ Carbon\Carbon::parse($item->time)->format('F j\\, Y H:i') }}</td>
          <td>{{ $item->type }}</td>
          <td>{{ $user->id == $item->patient_id ? $item->reason : '' }}</td>
          <td class="p-0 align-middle text-right d-print-none">
            @if ( $item->patient_id == $user->id)
              <a class="btn btn-sm d-inline-block" href="{{ route('appointments.show', $item->id) }}">View</a>
              <form class="d-inline-block" action="{{ route('appointments.destroy', $item->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE"/>
                <button class="btn btn-sm btn-link text-danger">Delete</button>
              </form>
            @endif
          </td>
        </tr>
      @endforeach
    @else
      @foreach ($appointments as $item)
        <tr>
          <td>{{ CEM\User::find($item->patient_id)->name }}</td>
          <td>{{ CEM\User::find(CEM\Doctor::find($item->doctor_id)->user_id)->name }}</td>
          <td>{{ Carbon\Carbon::parse($item->time)->format('F j\\, Y H:i') }}</td>
          <td>{{ $item->type }}</td>
          <td>{{ $item->reason }}</td>
          <td class="p-0 align-middle text-right d-print-none">
            <a class="btn btn-sm" href="{{ route('appointments.show', $item->id) }}">View</a>
            <form class="d-inline-block" action="{{ route('appointments.destroy', $item->id) }}" method="post">
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
  {!! $appointments->render() !!}
@endsection
