<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Entities\MemberEntity;
use Illuminate\Support\Collection;

class Member extends UtalkBase
{
    /**
     * @description Retorna os dados do usuário logado
     *
     * @throws UtalkException
     */
    public function getMe(): MemberEntity
    {
        $req = $this->service
            ->refreshToken()
            ->get('/members/me/');
        $req->onError(fn ($e) => $this->error($e));

        return new MemberEntity($req->json());
    }

    /**
     * @description Retorna os usuários online
     */
    public function getOnline(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/members/online/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $this->transform($req->json(), MemberEntity::class);
    }
}
