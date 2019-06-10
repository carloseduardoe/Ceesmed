<?php

namespace CEM\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
  public function boot()
  {
    Schema::defaultStringLength('191');
  }

  //Register any application services.
  public function register()
  {
    //$this->app['request']->server->set('HTTPS', true);
  }
}
