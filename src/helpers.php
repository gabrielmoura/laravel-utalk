<?php

use Gabrielmoura\LaravelUtalk\UtalkService;

if (! function_exists('utalk')) {

    function utalk(): UtalkService
    {
        return app(UtalkService::class);
    }
}
