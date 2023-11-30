<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Sector;

trait HasSector
{
    public function sector(): Sector
    {
        return new Sector();
    }
}
