@extends('layouts.level2.index')

@section('title')
Roles
@endsection

@section('action')
  @if (Auth::user()->hasRole(['admin']))
    <a class="btn btn-primary float-right" role="button" href="{{ route('roles.create') }}">New Role</a>
  @endif
@endsection

@php
  $viewer = Auth::user();
@endphp

@section('table')
    <tr>
      <th scope="col">Role</th>
      <th scope="col" colspan="2">User</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
      <tr>
        <td>{{ $item->role }}</td>
        <td>{{ $item->user }}</td>
        <td class="p-1 align-middle text-right d-print-none">
          <a class="btn btn-sm text-info" href="{{ route($item->role == 'doctor' ? 'profile.doctor' : 'profile.patient', $item->user_id) }}">Profile</a>
          @if ($viewer->id == $item->user_id)
            @if ($item->role != 'admin')
              <form class="d-inline-block" action="{{ route('roles.destroy', $item->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE"/>
                <button class="btn btn-sm btn-link text-danger">Cancel</button>
              </form>
            @endif
          @else
            <form class="d-inline-block" action="{{ route('roles.destroy', $item->id) }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE"/>
              <button class="btn btn-sm btn-link text-danger">Cancel</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
@endsection

@section('pagination')
  {!! $data->render() !!}
@endsection
