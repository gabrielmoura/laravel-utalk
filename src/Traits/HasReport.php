<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Report;

trait HasReport
{
    public function report(): Report
    {
        return new Report();
    }
}
