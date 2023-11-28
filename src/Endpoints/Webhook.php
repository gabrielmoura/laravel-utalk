<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class Webhook extends UtalkBase
{
    /**
     * @description Retorna os webhooks
     *
     * @throws UtalkException
     */
    public function get(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/webhooks/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->getMessage(), $e->getCode());
        });

        return $req->collect();
    }

    /**
     * @description Atribui um webhook
     *
     * @throws UtalkException
     */
    public function set(string $organizationId, string $name, string $url, array $channelIds): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->post('/webhooks/', [
                'organizationId' => $organizationId,
                'name' => $name,
                'url' => $url,
                'channelIds' => $channelIds,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->getMessage(), $e->getCode());
        });

        return $req->collect();
    }
}
