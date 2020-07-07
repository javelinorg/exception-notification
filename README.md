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
    | Here you can specify an array of recipients
    |
    */

    'toAddresses' => [
        'email1@example.com',
        'email2@example.com',
        'email3@example.com',
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue customization
    |--------------------------------------------------------------------------
    |
    | Exception notificaiton will send directly by default,
    | Howerver you can enable the use of queues and customize it as per your needs.
    |
    */

    'queueOptions' => [
        'enabled' => env('EXCEPTION_NOTIFICATION_SHOULD_QUEUE',false),
        'queue' => env('EXCEPTION_NOTIFICATION_QUEUE_NAME', 'default'),
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
Add the line following line to the report method in App/Exceptions/Handler.php

```php
app('exceptionNotification')->reportException($exception);
```

Once added, the mehod should look something like this:

``` php
  public function report(Exception $exception) {
    app('exceptionNotification')->reportException($exception); // <-- The line you added
    parent::report($exception);
  }
```

Once Exception-Notification is installed and configured you can trigger a test exception by running:

``` bash
php artisan exception:throw
```

## Testing

To run tests simply run:

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
