<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Support\Collection;

class ActivityLogs extends UtalkBase
{
    /**
     * @description Busca os logs de atividade
     *
     * @return Collection<string, array<string, mixed>>
     */
    public function get(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/activity-logs/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
