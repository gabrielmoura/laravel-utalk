<?php

use Gabrielmoura\LaravelUtalk\Utalk;

if (! function_exists('utalk')) {

    function utalk(): Utalk
    {
        return app('Utalk');
    }
}
