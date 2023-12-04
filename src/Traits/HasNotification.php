<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Notifications;

trait HasNotification
{
    public function notification(): Notifications
    {
        return new Notifications();
    }
}
