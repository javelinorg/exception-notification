<?php

namespace Javelin\ExceptionNotification;

use Illuminate\Support\ServiceProvider;
use Javelin\ExceptionNotification\ExceptionNotification;
use Javelin\ExceptionNotification\Commands\ExceptionNotificationTestCommand;

class ExceptionNotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/exception-notification.php' => config_path('exception-notification.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/exception-notification'),
            ], 'views');

            $this->commands([
                ExceptionNotificationTestCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'exception-notification');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/exception-notification.php', 'exception-notification');
        $this->app->singleton('exceptionNotification', function ($app) {
            return $app->make(ExceptionNotification::class);
        });
    }
}
