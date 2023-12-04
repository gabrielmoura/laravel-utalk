<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\ScheduledMessage;

trait HasScheduledMessage
{
    public function scheduled(): ScheduledMessage
    {
        return new ScheduledMessage();
    }
}
