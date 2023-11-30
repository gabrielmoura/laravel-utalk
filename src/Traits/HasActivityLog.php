<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\ActivityLogs;

trait HasActivityLog
{
    public function activityLog(): ActivityLogs
    {
        return new ActivityLogs();
    }
}
