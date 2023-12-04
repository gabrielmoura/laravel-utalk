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

    /**
     * @description Valida se o timestamp é um formato válido
     *
     * @param  string  $time Um timestamp no padrão ISO 8601
     *
     * @throws UtalkException
     */
    public static function timestamp(string $time): void
    {
        if (! preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}%3A\d{2}%3A\d{2}\.\d{7}Z$/', $time)) {
            throw new UtalkException('O timestamp não tem um formato válido.');
        }
    }

    /**
     * @description Valida se uma string é menor ou igual a um valor
     *
     * @param  string  $value Valor a ser validado
     * @param  int  $smallerThen Valor máximo mínimo
     * @param  string  $field Nome do campo
     * @param  bool  $nullable Se o campo pode ser nulo
     *
     * @throws UtalkException
     */
    public static function strSmallerThen(string $value, int $smallerThen, string $field, bool $nullable = false): void
    {
        if ($value == null && $nullable) {
            return;
        }
        if (strlen($value) <= $smallerThen) {
            throw new UtalkException("O $field deve ter no máximo $smallerThen caracteres");
        }
    }

    /**
     * @description Valida se uma string é maior ou igual a um valor
     *
     * @param  string  $value Valor a ser validado
     * @param  int  $biggerThen Valor mínimo
     * @param  string  $field Nome do campo
     * @param  bool  $nullable Se o campo pode ser nulo
     *
     * @throws UtalkException
     */
    public static function strBiggerThen(string $value, int $biggerThen, string $field, bool $nullable = false): void
    {
        if ($value == null && $nullable) {
            return;
        }
        if (strlen($value) >= $biggerThen) {
            throw new UtalkException("O $field deve ter pelo menos $biggerThen caracteres");
        }
    }
}
