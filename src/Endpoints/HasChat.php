<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasChat
{
    public function chat(): Chat
    {
        return new Chat();
    }
}
