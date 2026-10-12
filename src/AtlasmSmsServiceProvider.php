<?php

declare(strict_types=1);

namespace Atlasm\Sms;

use Illuminate\Support\ServiceProvider;

class AtlasmSmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/atlasm-sms.php',
            'atlasm-sms'
        );

        $this->app->singleton(SmsService::class, function ($app) {
            return new SmsService(
                (array) $app['config']->get('atlasm-sms', []),
                null,
                $app->make('log')
            );
        });

        $this->app->alias(SmsService::class, 'atlasm-sms');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/atlasm-sms.php' => config_path('atlasm-sms.php'),
            ], 'atlasm-sms-config');
        }
    }
}
