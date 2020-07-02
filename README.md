# The Exception Notification package sends a mail notification when exception occurs in a Laravel application.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/javelinorg/exception-notification.svg?style=flat-square)](https://packagist.org/packages/javelinorg/exception-notification)
![Tests](https://github.com/javelinorg/exception-notification/workflows/Tests/badge.svg?branch=master)
![Psalm](https://github.com/javelinorg/exception-notification/workflows/Psalm/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/javelinorg/exception-notification.svg?style=flat-square)](https://packagist.org/packages/javelinorg/exception-notification)

## Installation

You can install the package via composer:

```bash
composer require javelinorg/exception-notification
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Javelin\ExceptionNotification\ExceptionNotificationServiceProvider" --tag="config"
```

You can publish the view files with:
```bash
php artisan vendor:publish --provider="Javelin\ExceptionNotification\ExceptionNotificationServiceProvider" --tag="views"
```

This is the contents of the published config file:

``` php

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
        "bar@example.com"
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
        'enabled' => env('EXCEPTION_NOTIFICATION_SHOULD_QUEUE',true),
        'queue' => env('EXCEPTION_NOTIFICATION_QUEUE_NAME', "default"),
        'connection' => env('QUEUE_DRIVER', 'redis'),
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


```

## Usage
 Add the below line in the report method in App/Exceptions/Handler.php
 
``` php

  public function report(Exception $exception) {
    app('exceptionNotification')->reportException($exception); // <-- Add this line
    parent::report($exception);
  }
   
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Javelin](https://github.com/Javelinorg)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
