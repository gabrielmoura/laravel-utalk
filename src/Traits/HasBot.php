<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Bot;

trait HasBot
{
    public function bot(): Bot
    {
        return new Bot();
    }
}
