<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Chat;

trait HasChat
{
    public function chat(): Chat
    {
        return new Chat();
    }
}
