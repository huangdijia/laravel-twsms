# SMS gateway for twsms

[![Latest Stable Version](https://poser.pugx.org/huangdijia/laravel-twsms/version.png)](https://packagist.org/packages/huangdijia/laravel-twsms)
[![Total Downloads](https://poser.pugx.org/huangdijia/laravel-twsms/d/total.png)](https://packagist.org/packages/huangdijia/laravel-twsms)

## Requirements

* PHP >= 7.0
* Laravel >= 5.5

## Installation

```bash
composer require huangdijia/laravel-twsms
```

## Publish

```bash
php artisan vendor:publish --provider="Huangdijia\Twsms\Providers\TwsmsServiceProvider"
```

## Configure

```env
TWSMS_ACCOUNT=account
TWSMS_PASSWORD=password
TWSMS_TYPE=now
TWSMS_ENCODING=big5
TWSMS_VLDTIME=
TWSMS_DLVTIME=
```

## Usage

### Command

```bash
php artisan twsms:send [mobile] [message]
```

### Facade

```php
Huangdijia\Twsms\Facades\Twsms::send($mobile, $message);
```

### Container

```php
app('sms.twsms')->send($mobile, $message);
```

## Error

```php
$twsms = app('sms.twsms');

if (!$twsms->send($mobile, $message)) {
    dd($twsms->getError());
}
```