@extends('layouts.level2.show')

@section('title')
Media details
@endsection

@section('header')
  <p><strong>Name:</strong> {{ $medium->path }}</p>
  <p><strong>Type:</strong> {{ $medium->mime }}</p>
@endsection

@section('details')
  <div class="row pb-3">
    <div class="col-12">
      @if (substr($medium->mime, 0, 5) == 'image')
        <img class="w-100" src="{{ route('media.deliver', $medium->id) }}" alt="file error">
      @elseif (substr($medium->mime, 0, 5) == 'video')
        <video class="w-100" src="{{ route('media.deliver', $medium->id) }}" autoplay controls></video>
      @else
        <a class="btn btn-sm btn-outline-primary mb-3" href="{{ route('media.deliver', $medium->id) }}">Download</a>
      @endif
    </div>
  </div>
@endsection

@section('footer')
  <form class="d-inline-block" action="{{ route('media.destroy', $medium->id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE"/>
    <button class="btn btn-sm btn-danger" type="submit" name="button">Delete File</button>
  </form>
@endsection
