<?php

return [
  //Application Name --> This value is used when the framework needs to place the application's name whenever required.
  'name' => env('APP_NAME'),

  //Application Environment --> The"environment" your application is currently running in.
  'env' => env('APP_ENV'),

  //Application Debug Mode --> Show detailed error messages with stack traces. If disabled, a simple generic error page is shown.
  'debug' => env('APP_DEBUG'),

  //Application URL --> This is used by the console to generate URLs when using Artisan, set this to the base url.
  'url' => env('APP_URL'),

  //Application Timezone --> The default timezone for your application, this will be used by the PHP date and date-time functions.
  'timezone' => env('APP_TIMEZONE'),

  //Application Locale Configuration --> The default locale that will be used by the translation service provider.
  'locale' => env('APP_LOCALE'),

  //Application Fallback Locale --> The locale to use when the current one is not available.
  'fallback_locale' => env('APP_FALLBACK_LOCALE'),

  //Encryption Key --> A random, 32 character string used by the Illuminate encrypter service, otherwise it will not be safe.
  'key' => env('APP_KEY'),
  'cipher' => env('APP_CIPHER'),

  //Logging Configuration --> Laravel uses the Monolog PHP logging library with a variety of powerful log handlers/formatters.
  //Available Settings: "single", "daily", "syslog", "errorlog"
  'log' => env('APP_LOG'),
  'log_level' => env('APP_LOG_LEVEL'),

  //Autoloaded Service Providers --> These service providers will be automatically loaded on a request to your application.
  'providers' => [
    //Laravel Framework Service Providers...
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Mail\MailServiceProvider::class,
    Illuminate\Notifications\NotificationServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Pipeline\PipelineServiceProvider::class,
    Illuminate\Queue\QueueServiceProvider::class,
    Illuminate\Redis\RedisServiceProvider::class,
    Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,

    //Package Service Providers...

    //Application Service Providers...
    CEM\Providers\AppServiceProvider::class,
    CEM\Providers\AuthServiceProvider::class,
    // CEM\Providers\BroadcastServiceProvider::class,
    CEM\Providers\EventServiceProvider::class,
    CEM\Providers\RouteServiceProvider::class,
  ],

  //Class Aliases --> Class aliases registered when the application is started, these aliases are "lazy" loaded so they don't hinder performance.
  'aliases' => [
    'App'          => Illuminate\Support\Facades\App::class,
    'Artisan'      => Illuminate\Support\Facades\Artisan::class,
    'Auth'         => Illuminate\Support\Facades\Auth::class,
    'Blade'        => Illuminate\Support\Facades\Blade::class,
    'Broadcast'    => Illuminate\Support\Facades\Broadcast::class,
    'Bus'          => Illuminate\Support\Facades\Bus::class,
    'Cache'        => Illuminate\Support\Facades\Cache::class,
    'Config'       => Illuminate\Support\Facades\Config::class,
    'Cookie'       => Illuminate\Support\Facades\Cookie::class,
    'Crypt'        => Illuminate\Support\Facades\Crypt::class,
    'DB'           => Illuminate\Support\Facades\DB::class,
    'Eloquent'     => Illuminate\Database\Eloquent\Model::class,
    'Event'        => Illuminate\Support\Facades\Event::class,
    'File'         => Illuminate\Support\Facades\File::class,
    'Gate'         => Illuminate\Support\Facades\Gate::class,
    'Hash'         => Illuminate\Support\Facades\Hash::class,
    'Lang'         => Illuminate\Support\Facades\Lang::class,
    'Log'          => Illuminate\Support\Facades\Log::class,
    'Mail'         => Illuminate\Support\Facades\Mail::class,
    'Notification' => Illuminate\Support\Facades\Notification::class,
    'Password'     => Illuminate\Support\Facades\Password::class,
    'Queue'        => Illuminate\Support\Facades\Queue::class,
    'Redirect'     => Illuminate\Support\Facades\Redirect::class,
    'Redis'        => Illuminate\Support\Facades\Redis::class,
    'Request'      => Illuminate\Support\Facades\Request::class,
    'Response'     => Illuminate\Support\Facades\Response::class,
    'Route'        => Illuminate\Support\Facades\Route::class,
    'Schema'       => Illuminate\Support\Facades\Schema::class,
    'Session'      => Illuminate\Support\Facades\Session::class,
    'Storage'      => Illuminate\Support\Facades\Storage::class,
    'URL'          => Illuminate\Support\Facades\URL::class,
    'Validator'    => Illuminate\Support\Facades\Validator::class,
    'View'         => Illuminate\Support\Facades\View::class,
  ],
];
