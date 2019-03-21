<?php
return [
    'account'  => env('TWSMS_ACCOUNT', ),
    'password' => env('TWSMS_PASSWORD', ),
    'type'     => env('TWSMS_TYPE', 'now'),
    'encoding' => env('TWSMS_ENCODING', 'big5'),
    'vldtime'  => env('TWSMS_VLDTIME', ''),
    'dlvtime'  => env('TWSMS_DLVTIME', ''),
];
