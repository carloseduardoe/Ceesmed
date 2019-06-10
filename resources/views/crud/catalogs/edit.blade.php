@extends('layouts.level2.cred')

@section('title')
Modify Catalog
@endsection

@section('details')
  <form class="" action="{{ route('catalogs.update') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT"/>
    @foreach ($catalogs as $item)
      <div class="form-group">
        <label for="{{ substr($item->key, 0, 11) }}">{{ substr($item->key, 11) }}</label>
        <input class="form-control" type="text" name="{{ substr($item->key, 0, 11) }}" value="{{ $item->value }}"/>
      </div>
    @endforeach
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('home', 'admin') }}">Cancel</a>
    </div>
  </form>
@endsection
