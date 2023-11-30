<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\UtalkService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class UtalkBase
{
    protected UtalkService $service;

    public function __construct()
    {
        $this->service = new UtalkService();
    }

    /**
     * @return Collection<int,object>
     */
    protected function transform(mixed $json, string $entity): Collection
    {
        return collect($json)
            ->map(fn ($sport) => new $entity($sport));
    }

    /**
     * @description Trata os erros da API
     *
     * @throws UtalkException
     */
    protected function error(RequestException $e): void
    {
        throw new UtalkException($e->response->json() ?? $e->getMessage(), $e->response->status());
    }
}
