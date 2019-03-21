<?php
if (!function_exists('twsms')) {
    function twsms()
    {
        return app('sms.twsms');
    }
}

if (!function_exists('twsms_send')) {
    function twsms_send($mobile = '', $message = '')
    {
        return app('sms.twsms')->send($mobile, $message) ?: app('sms.twsms')->getError();
    }
}