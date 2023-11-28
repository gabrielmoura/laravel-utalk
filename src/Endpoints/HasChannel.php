<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasChannel
{
    public function channel(): Channel
    {
        return new Channel();
    }
}
