@extends('layouts.level2.index')

@section('title')
User Index
@endsection

@section('action')
  @if (!Auth::user()->isJustPatient())
    <a class="btn btn-primary float-right" role="button" href="{{ route('patients.create') }}">New user</a>
  @endif
@endsection

@section('table')
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col" colspan="2">Updated</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $item)
      <tr>
        <td>{{ $item->nid }}</td>
        <td><strong>{{ $item->name }}</strong></td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->updated_at->format('F j\\, Y H:i') }}</td>
        <td class="p-0 align-middle text-right d-print-none">
          <a class="btn btn-sm d-inline-block" href="{{ route('users.show', $item->id) }}">Details</a>
          <a class="btn btn-sm d-inline-block" href="{{ route('users.edit', $item->id) }}">Update</a>
          @if ($item->active)
            <a class="btn btn-sm text-danger d-inline-block" href="{{ route('users.suspend', $item->id) }}">Suspend</a>
          @else
            <form class="d-inline-block" action="{{ route('users.activate', $item->id) }}" method="post">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-sm btn-link text-success">Activate</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
@endsection

@section('pagination')
  {!! $users->render() !!}
@endsection
