<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasSector
{
    public function sector(): Sector
    {
        return new Sector();
    }
}
