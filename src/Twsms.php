<?php

namespace Huangdijia\Twsms;

use Exception;
use Illuminate\Support\Facades\Http;

class Twsms
{
    protected $config = [];
    protected $apis   = [
        'send_sms' => 'http://api.twsms.com/send.php',
    ];

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Send sms
     * @param string $mobile 
     * @param string $message 
     * @return true 
     */
    public function send($mobile = '', $message = '')
    {
        throw_if(empty($this->config['account']), new Exception("config twsms.account is undefined", 101));

        throw_if(empty($this->config['password']), new Exception("config twsms.password is undefined", 102));

        throw_if(!$this->checkMobile($mobile), new Exception("mobile is error"));

        throw_if(!$this->checkMessage($message), new Exception("message is message"));

        $data = [
            'username' => $this->config['account'],
            'password' => $this->config['password'],
            'type'     => $this->config['type'] ?? 'now',
            'encoding' => $this->config['encoding'] ?? 'big5',
            'vldtime'  => $this->config['vldtime'],
            'dlvtime'  => $this->config['dlvtime'],
            'mobile'   => $mobile,
            'message'  => iconv('utf-8', $this->config['encoding'] ?? 'big5' . '//IGNORE', $message),
        ];

        $response = Http::post($this->apis['send_sms'], $data)->throw();

        [$key, $msgid] = explode('=', $response);

        throw_if($msgid <= 0, new Exception("Send failed"));

        return true;
    }

    /**
     * Check mobile
     * @param string $mobile
     * @return bool
     */
    protected function checkMobile($mobile = '')
    {
        return preg_match('/^09\d{8}$/', $mobile) ? true : false;
    }

    /**
     * Check message
     * @param string $message
     * @return bool
     */
    protected function checkMessage($message = '')
    {
        return !empty($message) ? true : false;
    }
}
