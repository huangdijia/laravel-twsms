# laravel-twsms

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