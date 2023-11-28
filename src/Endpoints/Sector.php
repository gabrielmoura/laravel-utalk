<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Entities\SectorEntity;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class Sector extends UtalkBase
{
    /**
     * @description Retorna os setores da organização
     *
     * @throws UtalkException
     */
    public function sectors(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/sectors/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->getMessage(), $e->getCode());
        });

        return $this->transform($req->json(),
            SectorEntity::class);
    }
}
