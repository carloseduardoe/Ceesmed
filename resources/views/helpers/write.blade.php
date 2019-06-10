@extends('layouts.level2.cred')

@section('title')
  Create Document
@endsection

@section('details')
  <form action="{{ route('home.print') }}" method="POST" target="_blank">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">Document Title</label>
      <input class="form-control" type="text" name="title" value="{{ old('title') ?: $data['title'] }}">
    </div>
    <div class="form-group">
      <label for="header">Header</label>
      <textarea class="form-control" name="header" rows="6">{{ old('header') ?: $data['header'] }}</textarea>
    </div>
    <div class="form-group">
      <label for="body">Document Body</label>
      <textarea class="form-control" name="body" rows="10">{{ old('body') ?: $data['body'] }}</textarea>
    </div>
    <div class="form-group row">
      <label for="signature" class="col-2 col-form-label">Signature</label>
      <div class="col-10">
        <input type="text" class="form-control" name="signature" value="{{ old('signature') ?: $data['signature'] }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="name" class="col-2 col-form-label">Name</label>
      <div class="col-10">
        <input type="text" class="form-control" name="name" value="{{ old('name') ?: Auth::user()->name }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="position" class="col-2 col-form-label">Position</label>
      <div class="col-10">
        <input type="text" class="form-control" name="position" value="{{ old('position') }}">
      </div>
    </div>
    <div class="form-group text-right">
      <button class="btn btn-primary" type="submit">Print</button>
      <a class="btn btn-primary" href="{{ URL::previous() }}">Cancel</a>
    </div>
  </form>
@endsection
