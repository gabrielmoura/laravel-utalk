<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasActivityLog
{
    public function activityLog(): ActivityLogs
    {
        return new ActivityLogs();
    }
}
