<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class ActivityLogs extends UtalkBase
{
    /**
     * @description Busca os logs de atividade
     */
    public function get(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/activity-logs/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->response->json() ?? 'HTTP request returned status code '.$e->response->status(), $e->response->status());
        });

        return $req->collect();
    }
}
