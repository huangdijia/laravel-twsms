<?php

namespace Huangdijia\Twsms\Console;

use Exception;
use Illuminate\Console\Command;

class SendCommand extends Command
{
    protected $signature   = 'twsms:send {mobile : Mobile Number} {message : Message Content}';
    protected $description = 'Send a message by twsms';

    public function handle()
    {
        $mobile  = $this->argument('mobile');
        $message = $this->argument('message');

        try {
            $this->laravel->make('sms.twsms')->send($mobile, $message);
        } catch (Exception $e) {
            $this->error($e->getMessage(), 1);
            return;
        }

        $this->info('send success!', 0);
    }
}
