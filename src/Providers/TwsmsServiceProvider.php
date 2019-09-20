<?php

namespace Huangdijia\Twsms\Providers;

use Huangdijia\Twsms\Console\SendCommand;
use Huangdijia\Twsms\Twsms;
use Illuminate\Support\ServiceProvider;

class TwsmsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    protected $commands = [
        SendCommand::class,
    ];

    public function boot()
    {
        $this->bootConfig();

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../../config/config.php' => $this->app->basePath('config/twsms.php')]);
        }
    }

    public function register()
    {
        $this->app->singleton(Twsms::class, function () {
            return new Twsms(config('twsms'));
        });

        $this->app->alias(Twsms::class, 'sms.twsms');

        $this->commands($this->commands);
    }

    public function bootConfig()
    {
        $path = __DIR__ . '/../../config/config.php';

        $this->mergeConfigFrom($path, 'twsms');
    }

    public function provides()
    {
        return [
            Twsms::class,
            'sms.twsms',
        ];
    }
}
