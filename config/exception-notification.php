<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Notification
    |--------------------------------------------------------------------------
    |
    | Exception notification enabled by default.
    | You can disable by setting enabled to false.
    */

    'enabled' => env('EXCEPTION_NOTIFICATION', true),

    /*
    |--------------------------------------------------------------------------
    | Error email recipients
    |--------------------------------------------------------------------------
    |
    | Here you can specify the list of recipients
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'foo@example.com'),
        'name'    => env('MAIL_FROM_NAME', 'Foo'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Error email recipients
    |--------------------------------------------------------------------------
    |
    | Here you can specify the list of recipients
    |
    */

    'toAddresses' => [
        'bar@example.com'
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue customization
    |--------------------------------------------------------------------------
    |
    | Exception notificaiton will send throuh the queue by default,
    | Howerver you can customize it as per your needs.
    |
    */

    'queueOptions' => [
        'enabled'       => env('EXCEPTION_NOTIFICATION_SHOULD_QUEUE',true),
        'queue'         => env('EXCEPTION_NOTIFICATION_QUEUE_NAME', "default"),
        'connection'    => env('QUEUE_DRIVER', 'redis'),
    ],

    /*
    |--------------------------------------------------------------------------
    | A list of the exception types that should be reported.
    |--------------------------------------------------------------------------
    |
    | For which exception class emails should be sent?
    |
    | You can use '*' in the array which will in turn reports every
    | exception.
    |
    */

    'report' => [
        '*',
    ],

    /*
    |--------------------------------------------------------------------------
    | Crawler Bots
    |--------------------------------------------------------------------------
    |
    | Ignore Crawler Bots
    | You can use '*" in the array to ignore all kind of bots or you can specify only particular bots.
    |
    */

    'ignored_bots' => [
        '*',
    ],
];
