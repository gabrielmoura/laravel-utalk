<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Webhook;

trait HasWebhook
{
    public function webhook(): Webhook
    {
        return new Webhook();
    }
}
