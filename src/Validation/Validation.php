<?php

namespace Gabrielmoura\LaravelUtalk\Validation;

use Gabrielmoura\LaravelUtalk\Endpoints\UtalkException;

class Validation
{
    /**
     * @description Valida se o telefone é um número válido
     *
     * @param  string  $numberPhone Um número de telefone no padrão E.164
     *
     * @throws UtalkException
     */
    public static function numberPhone(string $numberPhone): void
    {
        if (! preg_match('/^\+[1-9]\d{1,14}$/', $numberPhone)) {
            throw new UtalkException('O telefone não é um número válido.');
        }
    }
}
