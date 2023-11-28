<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Entities\ChannelEntity as ChannelEntity;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class Channel extends UtalkBase
{
    /**
     * @description Busca os canais de atendimento
     */
    public function channels(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/channels/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->getMessage(), $e->getCode());
        });

        return $this->transform($req->json(),
            ChannelEntity::class);
    }
}
