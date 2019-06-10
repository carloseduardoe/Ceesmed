@extends('layouts.level1.page')

@section('content')
  <div class="row h-100">
    <div class="col-2" height="100px">
      <img class="bg-dark mw-100" src="{{ asset('brand/logo.png') }}">
    </div>
    <div class="col-10">
      <h2 class="">Centro de Especialidades Médicas</h2>
      @if (Auth::user()->hasRole(['doctor']))
        <h3 class="">Dr. {{ Auth::user()->name }}</h3>
        @foreach (Auth::user()->doctors as $item)
          <h6>{{ $item->specialty }}</h6>
        @endforeach
      @endif
    </div>
  </div>
  <hr class="pb-5">
  @if ($data['title'])
    <div class="row pb-5">
      <div class="col-12 text-center">
        <h3>{{ $data['title'] }}</h3>
      </div>
    </div>
  @endif
  @if ($data['header'])
    <div class="row pb-5">
      <div class="col-12">
        <p style="white-space: pre-line">{{ $data['header'] }}</p>
      </div>
    </div>
  @endif
  <div class="row py-5">
    <div class="col-12">
      <p style="white-space: pre-line">{{ $data['body'] }}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-12 pb-5">
      <p>{!! $data['signature'] !!}</p>
    </div>
    <div class="col-12 ml-3 border-dark border-bottom" style="max-width: 200px"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <p>{!! $data['name'] !!}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <p>{!! $data['position'] !!}</p>
    </div>
  </div>
@endsection
