<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Message;

trait HasMessage
{
    public function message(): Message
    {
        return new Message();
    }
}
