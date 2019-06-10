@extends('layouts.level2.index')

@section('title')
  @if (isset($name))
    Dr. {{ $name }}
  @else
    Doctor Schedules
  @endif
@endsection

@section('action')
  @if (Auth::user()->hasRole(['admin']))
    <a class="btn btn-primary float-right" role="button" href="{{ route('schedules.create') }}">Create schedule</a>
  @endif
@endsection

@section('table')
    <tr>
      <th scope="col">Doctor</th>
      <th scope="col">Day</th>
      <th scope="col">Start</th>
      <th scope="col" colspan="2">End</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($doctors as $item)
      @foreach ($item->schedules as $sk => $sch)
        <tr>
          <td>
            @if($sk == 0)
              <strong>{{ CEM\User::find($item->user_id)->name }}</strong> ({{ $item->specialty }})
            @endif
          </td>
          <td>
            @php
            switch ($sch->day) {
              case 'mon': echo "Monday";    break;
              case 'tue': echo "Tuesday";   break;
              case 'wed': echo "Wednesday"; break;
              case 'thu': echo "Thursday";  break;
              case 'fri': echo "Friday";    break;
              case 'sat': echo "Saturday";  break;
              case 'sun': echo "Sunday";    break;
            }
            @endphp
          </td>
          <td>{{ substr($sch->start, 0, 5) }}</td>
          <td>{{ substr($sch->end, 0, 5) }}</td>
          <td class="p-0 align-middle text-right d-print-none">
            <form class="d-inline-block" action="{{ route('schedules.destroy', $sch->id) }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE"/>
              <button class="btn btn-sm btn-link text-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    @endforeach
@endsection

@section('pagination')
  {!! $doctors->render() !!}
@endsection
