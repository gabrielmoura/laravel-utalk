# Laravel Utalk

## Objective

In this version, the purpose is to establish integration with the Utalk messaging service for sending and receiving messages. However, the currently implemented functionalities only reflect the rudimentary use of the API.

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

## WebHook IPs

It is possible to obtain the list of IPs that will be used for sending messages.

```php
utalk()->webhook()->getIps();
```
and define them in config/services.php

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

### Route WebHook

Certain webhooks retransmit the message if they do not receive an HTTP response code in the 20x range. Therefore, it is essential that the route responsible for receiving the webhook issues a success code before proceeding to handle the received message.

```php
// routes/web.php
    Route::utalk()
```


### Send Message

```php
// Send Message
    $utalk = new UtalkService();
    $utalk->message()->set(
        fromPhone: '+55***********',
        toPhone: '+55***********',
        organizationId: '********',
        message: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    );
```

It is encouraged to create a Listener for the event of receiving messages through the event.

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
            Log::debug("Received Message", (array)$event);
        } else {
            Log::debug("Other type of event", (array)$event);
        }

    }
}
```

### Configurations

```php
/** config/services.php **/

'utalk' => [
        'key' => env('UTALK_KEY'),
        'organizationId'=>env('UTALK_ORGANIZATION_ID'),
        'channelId'=> env('UTALK_CHANNEL_ID'),
    ],
```

## Disclaimer and Collaboration Notice for Development

We caution that the software may contain imperfections, errors, or bugs that may affect its performance in certain circumstances. We are committed to continuously improving this product and rely on the collaboration of the user community to identify and correct any issues.

If you identify any errors, bugs, or have suggestions for improvements or new features, we encourage you to share your findings with us through Pull Requests in the official repository. We believe that mutual collaboration is essential for the evolution of the software and the creation of a more robust and reliable environment for all users.

Thank you for your understanding and your contribution to the continuous improvement of this project.
