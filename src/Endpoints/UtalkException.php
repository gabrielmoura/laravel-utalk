<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use DomainException;
use Exception;
use Illuminate\Support\Facades\Log;

class UtalkException extends DomainException
{
    /**
     * Create a new exception instance.
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        $message = "UTalk: $message";
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
        Log::error($this->getMessage());
    }
}
