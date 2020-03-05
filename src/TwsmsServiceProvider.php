<?php

namespace Huangdijia\Twsms;

use Illuminate\Support\ServiceProvider;

class TwsmsServiceProvider extends ServiceProvider
{
    // protected $defer = true;

    protected $commands = [
        Console\InstallCommand::class,
        Console\SendCommand::class,
    ];

    public function boot()
    {
        $this->bootConfig();

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../../config/twsms.php' => $this->app->basePath('config/twsms.php')]);
        }
    }

    public function register()
    {
        $this->app->singleton(Twsms::class, function () {
            return new Twsms($this->app['config']->get('twsms', []));
        });

        $this->app->alias(Twsms::class, 'sms.twsms');

        $this->commands($this->commands);
    }

    public function bootConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/twsms.php', 'twsms');
    }

    public function provides()
    {
        return [
            Twsms::class,
            'sms.twsms',
        ];
    }
}
