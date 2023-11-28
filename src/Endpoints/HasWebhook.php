<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasWebhook
{
    public function webhook(): Webhook
    {
        return new Webhook();
    }
}
