<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Channel;

trait HasChannel
{
    public function channel(): Channel
    {
        return new Channel();
    }
}
