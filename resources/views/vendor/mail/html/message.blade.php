@component('mail::layout')
  @slot('header')
    @component('mail::header')
      {{ $header or 'Notification' }}
    @endcomponent
  @endslot

  @isset($body)
    @slot('body')
      @component('mail::body')
        {{ $body }}
      @endcomponent
    @endslot
  @endisset

  @isset($action)
    @slot('action')
      @component('mail::button', ['url' => $url, 'color' => $color])
        {{ $action }}
      @endcomponent
    @endslot
  @endisset

  @isset($subcopy)
    @slot('subcopy')
      @component('mail::subcopy')
        {{ $subcopy or '' }}
      @endcomponent
    @endslot
  @endisset

  @slot('footer')
    @component('mail::footer')
    @endcomponent
  @endslot
@endcomponent
