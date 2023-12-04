<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Support\Collection;

class Notifications extends UtalkBase
{
    /**
     * @description Retorna todas as notificações
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     */
    public function getAll(string $organizationId, int $skip = 0, int $take = 31): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/user-notifications/', [
                'organizationId' => $organizationId,
                'Skip' => $skip,
                'Take' => $take,
                'Behavior' => 'CountAllAndGetSlice',
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Marca uma notificação como lida
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $notificationId "AB_12-xyzEXAMPLE" ID da notificação
     */
    public function read(string $organizationId, string $notificationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->put("/user-notifications/{$notificationId}/", [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
