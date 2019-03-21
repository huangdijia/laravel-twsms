<?php

namespace Huangdijia\Twsms\Console;

use Illuminate\Console\Command;

class SendCommand extends Command
{
    protected $signature   = 'twsms:send {mobile : Mobile Number} {message : Message Content}';
    protected $description = 'Send a message by twsms';

    public function handle()
    {
        $mobile  = $this->argument('mobile');
        $message = $this->argument('message');
        $twsms   = app('sms.twsms');

        if (!$twsms->send($mobile, $message)) {
            $this->error($twsms->getError(), 1);
            return;
        }

        $this->info('send success!', 0);
    }
}
