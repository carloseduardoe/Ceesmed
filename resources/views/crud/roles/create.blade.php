@extends('layouts.level2.cred')

@section('title')
Assign new Role
@endsection

@section('details')
  <form class="" action="{{ route('roles.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col form-group">
        <label for="user_id">User</label>
        <select class="form-control" name="user_id">
          <option class="d-none"></option>
          @foreach ($users as $item)
            <option value="{{ $item->id }}">
              {{ $item->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col form-group">
        <label for="role_id">Role</label>
        <select class="form-control" name="role_id">
          <option class="d-none"></option>
          @foreach ($roles as $item)
            <option value="{{ $item->id }}">
              {{ $item->name }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('contacts.index') }}">Cancel</a>
    </div>
  </form>
@endsection
