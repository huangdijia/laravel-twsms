<?php

namespace Huangdijia\Twsms;

use Huangdijia\Curl\Facades\Curl;

class Twsms
{
    protected $config = [];
    protected $apis   = [
        'send_sms' => 'http://api.twsms.com/send.php',
    ];
    protected $init = true;

    public function __construct($config = [])
    {
        if (empty($config['account'])) {
            $this->error = "config twsms.account is undefined";
            $this->errno = 101;
            $this->init  = false;
            return;
        }
        if (empty($config['password'])) {
            $this->error = "config twsms.password is undefined";
            $this->errno = 102;
            $this->init  = false;
            return;
        }

        $this->config = $config;
    }

    public function send($mobile = '', $message = '')
    {
        if (!$this->init) {
            return false;
        }

        // 默认错误信息
        $this->error = null;
        $this->errno = null;

        // 检测数据
        if (!$this->checkMobile($mobile)) {
            return false;
        }

        if (!$this->checkMessage($message)) {
            return false;
        }

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

        $url      = $this->apis['send_sms'];
        $data     = http_build_query($data);
        $response = Curl::post($url, $data);

        if (false === $response) {
            $this->errno = 402;
            $this->error = '返回結果為空';
            return false;
        }

        [$key, $msgid] = explode('=', $response);

        if ($msgid <= 0) {
            $this->errno = 403;
            $this->error = '廠商發送失敗';
            return false;
        }

        return true;
    }

    protected function checkMobile($mobile = '')
    {
        return preg_match('/^09\d{8}$/', $mobile);
    }

    protected function checkMessage($message = '')
    {
        return !empty($message) ? true : false;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getErrno()
    {
        return $this->errno;
    }
}
