<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasMessage
{
    public function message(): Message
    {
        return new Message();
    }
}
