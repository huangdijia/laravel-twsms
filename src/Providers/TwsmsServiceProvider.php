<?php

namespace Huangdijia\Twsms\Providers;

use Huangdijia\Twsms\Console\InfoCommand;
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
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('twsms.php')]);
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

    public function provides()
    {
        return [
            Twsms::class,
            'sms.twsms',
        ];
    }
}
