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

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string  $name
     * @return string
     */
    function config_path($name = '')
    {
        if (is_callable(app(), 'getConfigurationPath')) {
            return app()->getConfigurationPath($name);
        } elseif (app()->has('path.config')) {
            return app()->make('path.config') . ($name ? DIRECTORY_SEPARATOR . $name : $name);
        } else {
            return app()->make('path') . '/../config' . ($name ? DIRECTORY_SEPARATOR . $name : $name);
        }
    }
}
