@extends('layouts.level2.index')

@section('title')
Doctor Index
@endsection

@section('action')
  @if (Auth::user()->hasRole(['admin']))
    <a class="btn btn-primary float-right" role="button" href="{{ route('doctors.create') }}">Create doctor</a>
  @endif
@endsection

@section('table')
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Specialty</th>
      <th scope="col" colspan="2">Position</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($doctors as $item)
      <tr>
        <td><strong>{{ CEM\User::find($item->user_id)->name }}</strong></td>
        <td>{{ $item->specialty }}</td>
        <td>{{ $item->position }}</td>
        <td class="p-0 align-middle text-right d-print-none">
          <a class="btn btn-sm" href="{{ route('profile.doctor', $item->user_id) }}">Profile</a>
          @if (Auth::user()->hasRole(['admin']))
            <a class="btn btn-sm" href="{{ route('doctors.edit', $item->id) }}">Update</a>
            {{-- @if (CEM\User::find($item->user_id)->active)
              <a class="btn btn-sm text-danger" href="{{ route('users.suspend', $item->user_id) }}">Suspend</a>
            @else
              <form class="d-inline-block" action="{{ route('users.activate', $item->user_id) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-link text-success">Activate</button>
              </form>
            @endif --}}
            <form class="d-inline-block" action="{{ route('doctors.destroy', $item->id) }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE"/>
              <button class="btn btn-sm btn-link text-danger">Delete</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
@endsection

@section('pagination')
  {!! $doctors->render() !!}
@endsection
