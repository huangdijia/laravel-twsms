<?php

namespace Huangdijia\Twsms\Facades;

use Illuminate\Support\Facades\Facade;
use Huangdijia\Twsms\Twsms as Accessor;

/**
 * @method static boolean send($mobile, $message)
 * @see Huangdijia\Twsms\Twsms
 */

class Twsms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Accessor::class;  
    }
}