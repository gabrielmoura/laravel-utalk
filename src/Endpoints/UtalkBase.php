<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\UtalkService;
use Illuminate\Support\Collection;

class UtalkBase
{
    protected UtalkService $service;

    public function __construct()
    {
        $this->service = new UtalkService();
    }

    protected function transform(mixed $json, string $entity): Collection
    {
        return collect($json)
            ->map(fn ($sport) => new $entity($sport));
    }
}
