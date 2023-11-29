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
### WebHook IPs

If your application is in an environment that requires IP whitelisting, use the following IPs:

* 40.88.132.66
* 52.188.209.245

### WebHook Route

Certain webhooks resend the message if they do not receive an HTTP response code in the 20x range. Therefore, it is essential that the route responsible for receiving the webhook emits a success code before proceeding to handle the received message.

Use /webhook/utalk or webhook.utalk.

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

It is encouraged to create a Listener for the event of receiving messages.

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

### Configuration

```php
/** config/services.php **/

'utalk' => [
    'key' => env('UTALK_KEY'),
    'organizationId' => env('UTALK_ORGANIZATION_ID'),
    'channelId' => env('UTALK_CHANNEL_ID'),
],
```

## Disclaimer and Collaboration Notice for Development

We caution that the software may contain imperfections, errors, or bugs that can affect its performance under certain circumstances. We are committed to continually improving this product and rely on the collaboration of the user community to identify and address any issues.

If you identify any errors, bugs, or have suggestions for improvements or new features, we encourage you to share your findings with us through Pull Requests in the official repository. We believe that mutual collaboration is essential for the evolution of the software and the creation of a more robust and reliable environment for all users.

We appreciate your understanding and your contribution to the continuous improvement of this project.
