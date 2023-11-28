# Laravel Utalk

## WebHook IPs
* 40.88.132.66
* 52.188.209.245

### Route WebHook
```php
// Route: routes/web.php
    Route::any('/utalk', function () {
        event(new UtalkWebhookEvent(request()->all()));
        return response()->noContent();
    })->name('utalk');
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

```php
<?php

namespace App\Listeners;

use Gabrielmoura\LaravelUtalk\Entities\PayloadEvent;
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
    public function handle(PayloadEvent $event): void
    {
        if ($event->type == 'Message') {
            Log::debug("Mensagem Recebida", (array)$event);
        } else {
            Log::debug("Outro tipo de evento", (array)$event);
        }

    }
}
```

