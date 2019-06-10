@extends('layouts.level2.show')

@section('title')
{{ $user->name }}
@endsection

@section('header')
  <p>ID: {{ $user->nid }}</p>
@endsection

@section('details')
  <p>eMail: {{ $user->email }}</p>
  <p>Created: {{ $user->created_at->diffForHumans() }}</p>
  <p>Updated: {{ $user->updated_at->diffForHumans() }}</p>
  <p>
    <a class="badge badge-pill badge-secondary" href="{{ route('profile.patient', $user->id) }}">Patient Profile</a>
    @if ($user->hasRole(['doctor']))
      <a class="badge badge-pill badge-secondary" href="{{ route('profile.doctor', $user->id) }}">Resume</a>
    @endif
  </p>
@endsection

@section('footer')
  <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
  @if ($user->active)
    <a class="btn btn-sm btn-danger" href="{{ route('users.suspend', $user->id) }}">Suspend</a>
  @else
    <form class="d-inline-block" action="{{ route('users.activate', $user->id) }}" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-sm btn-success">Activate</button>
    </form>
  @endif
@endsection
