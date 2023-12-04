<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\QuickAnswers;

trait HasQuickAnswers
{
    public function quickAnswers(): QuickAnswers
    {
        return new QuickAnswers();
    }
}
