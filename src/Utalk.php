<?php

namespace Gabrielmoura\LaravelUtalk;

use Illuminate\Support\Facades\Facade;

/**
 * @method channel() Channel
 *
 * @see \Gabrielmoura\LaravelUtalk\UtalkService
 */
class Utalk extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UtalkService::class;
    }
}
