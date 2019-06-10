<div class="row rounded-top rounded-0 bg-light border-right border-secondary d-none d-md-block mr-md-1">
  @foreach (['admin', 'agent', 'doctor'] as $value)
    @if (Auth::user()->hasRole([$value]))
      @include('layouts.partials.sidebar.'.$value)
    @endif
  @endforeach
</div>
