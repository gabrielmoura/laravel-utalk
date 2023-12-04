<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Entities\SectorEntity;
use Illuminate\Support\Collection;

class Sector extends UtalkBase
{
    /**
     * @description Retorna os setores da organização
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     */
    public function sectors(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/sectors/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $this->transform($req->json(),
            SectorEntity::class);
    }

    /**
     * @description Cria um novo setor
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $name Nome do setor
     */
    public function set(string $organizationId, string $name): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->post('/sectors/', [
                'Name' => $name,
                'OrganizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Delete setor
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $sectorId "AB_12-xyzEXAMPLE" ID do setor
     * @param  string  $moveChatsToSector "AB_12-xyzEXAMPLE" ID do setor para onde os chats serão movidos
     */
    public function delete(string $organizationId, string $sectorId, string $moveChatsToSector): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->delete("/sectors/$sectorId/", [
                'organizationId' => $organizationId,
                'moveChatsToSector' => $moveChatsToSector,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
