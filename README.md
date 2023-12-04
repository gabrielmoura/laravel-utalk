<p align="center">
<img src="doc/laravel-utalk.webp" alt="Laravel Utalk"/>
</p>

<p align="center">
<a href="https://packagist.org/packages/gabrielmoura/laravel-utalk"><img src="https://img.shields.io/packagist/v/gabrielmoura/laravel-utalk" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/gabrielmoura/laravel-utalk"><img src="https://img.shields.io/packagist/l/gabrielmoura/laravel-utalk" alt="License"></a>
</p>

- [Objective](#objective)
- [Usage](#usage)
    - [Facade](#facade)
    - [Container](#container)
    - [Helper](#helper)
- [WebHook](#webhook)
- [Configurations](#configurations)
- [Documentation](doc/DOC.md)

## Objective

In this version, the purpose is to establish integration with the Utalk messaging service for sending and receiving
messages. However, the currently implemented functionalities only reflect the rudimentary use of the API, and there is
no automation process.

## Usage

### Facade

```php
use Gabrielmoura\LaravelUtalk\Utalk;
Utalk::member()->getMe();
```

### Container

```php
app('Utalk')->member()->getMe();
```

### Helper

```php
utalk()->member()->getMe();
```

## WebHook

### IPs

You can obtain the list of IPs that will be used for message delivery.

```php
utalk()->webhook()->getIps();
```

### Optional Configuration

And define them in config/services.php

```php
'allow_ips' =>
            [
                '40.88.132.66/32',
                '52.188.209.245/32',
                '52.188.209.200/32',
                '40.88.5.13/32',
                '13.82.149.8/32',
                '20.121.215.166/32',
                '52.191.24.158/32',
            ]
```

By default, the package checks if the IP falls within the list of allowed IPs:

- 127.0.0.1/8
- 192.168.0.1/16
- 10.0.0.1/24
- 172.16.0.0/12
- 40.88.132.66/32
- 52.188.209.245/32
- 52.188.209.200/32
- 40.88.5.13/32
- 13.82.149.8/32
- 20.121.215.166/32
- 52.191.24.158/32

### WebHook Route

Certain webhooks resend the message if they do not receive an HTTP response code in the 20x range. Therefore, it is
essential that the route responsible for receiving the webhook issues a success code before proceeding to handle the
received message.

This package provides a route for receiving webhooks and middleware for checking the origin IP. To use it, simply add
the route to the routes file corresponding to _**/webhook/utalk**_.

```php
// routes/web.php
    Route::utalk()
```

It is encouraged to create a Listener for the event of receiving messages through the webhook.

```php
<?php

namespace App\Listeners;

use Gabrielmoura\LaravelUtalk\Events\UtalkWebhookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UtalkMessageRcvListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UtalkWebhookEvent $event): void
    {
        if ($event->type == 'Message') {
            Log::debug("Mensagem Recebida", (array)$event);
        } else {
            Log::debug("Outro tipo de evento", (array)$event);
        }

    }
}
```

## Sending a Message

```php
    $utalk = new UtalkService();
    $utalk->message()->set(
        fromPhone: '+55***********',
        toPhone: '+55***********',
        organizationId: '********',
        message: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    );
```

## Configurations

```php
/** config/services.php **/

'utalk' => [
        'key' => env('UTALK_KEY'),
        'organizationId'=>env('UTALK_ORGANIZATION_ID'),
        'channelId'=> env('UTALK_CHANNEL_ID'),
    ],
```

## Disclaimer and Collaboration Notice

We would like to alert you that the software may contain imperfections, errors, or bugs, which can affect its
performance under certain circumstances. We are committed to continuously improving this product and rely on the
collaboration of the user community to identify and correct any potential issues.

If you identify any errors, bugs, or have suggestions for improvements or new features, we encourage you to share your
findings with us through Pull Requests on the official repository. We believe that mutual collaboration is essential for
the evolution of the software and the creation of a more robust and reliable environment for all users.

This is not a package developed by Umbler, but rather a third-party package for integration with the messaging service.

We appreciate your understanding and your contribution to the continuous improvement of this project.
