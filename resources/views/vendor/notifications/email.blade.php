@component('mail::message')
  @slot('header')
    Password Reset
  @endslot

  @slot('body')
    {{-- Greeting --}}
    @if (! empty($greeting))
      # {{ $greeting }}
    @elseif ($level == 'error')
      # Whoops!
    @else
      # Hello!
    @endif

    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
      {{ $line }}
    @endforeach

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
      {{ $line }}
    @endforeach

    {{-- Salutation --}}
    @if (!empty($salutation))
      {{ $salutation }}
    @else
      Regards,<br>{{ env('APP_NAME') }}
    @endif
  @endslot

  {{-- Action Button --}}
  @isset($actionText)
    @slot('action')
      @php
        switch ($level) {
          case 'success': $color = 'success'; break;
          case 'error': $color = 'danger'; break;
          default: $color = 'primary'; break;
        }
      @endphp
      @component('mail::button', ['url' => $actionUrl, 'color' => $color])
        {{ $actionText }}
      @endcomponent
    @endslot
  @endisset

  {{-- Subcopy --}}
  @isset($actionText)
    @slot('subcopy')
      @component('mail::subcopy')
        {{ "If you’re having trouble clicking the \"".$actionText."\" button, copy and paste the URL below into your web browser: ".$actionUrl }}
      @endcomponent
    @endslot
  @endisset

@endcomponent
