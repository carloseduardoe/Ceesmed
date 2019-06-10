@component('mail::layout')
  @slot('header')
    @component('mail::header')
      {{ $header or 'Notification' }}
    @endcomponent
  @endslot

  @slot('body')
    @component('mail::body')
      {{ $body or '' }}
    @endcomponent
  @endslot

  @isset($action)
    @slot('action')
      @component('mail::button', ['url' => $url, 'color' => $color])
        {{ $action }}
      @endcomponent
    @endslot
  @endisset

  @slot('subcopy')
    @component('mail::subcopy')
      {{ $subcopy or '' }}
    @endcomponent
  @endslot

  @slot('footer')
    @component('mail::footer')
    @endcomponent
  @endslot
@endcomponent
