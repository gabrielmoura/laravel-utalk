<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Http\Client\RequestException;

class OrganizationInvites extends UtalkBase
{
    /**
     * @description Retorna todos os convites de uma organização
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @return array|mixed
     */
    public function get(string $organizationId)
    {
        $req = $this->service
            ->refreshToken()
            ->get('/organization-invites/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->response->json() ?? 'HTTP request returned status code '.$e->response->status(), $e->response->status());
        });

        return $req->json();
    }

    /**
     * @description Envia um convite para um usuário se tornar membro de uma organização
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  array  $permissions ["Member"]
     * @param  array  $allowedSector ["allSectorsEnable" => true, "sectors" => ["AB_12-xyzEXAMPLE"]]
     * @param  array  $allowedChannel ["allChannelsEnable" => true, "channels" => ["AB_12-xyzEXAMPLE"]]
     * @return array
     *
     * @throws UtalkException
     */
    public function set(string $organizationId, string $email, array $permissions, array $allowedSector, array $allowedChannel)
    {
        $req = $this->service
            ->refreshToken()
            ->post('/organization-invites/', [
                'organizationId' => $organizationId,
                'email' => $email,
                'permissions' => $permissions,
                'allowedSector' => $allowedSector,
                'allowedChannel' => $allowedChannel,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->response->json() ?? 'HTTP request returned status code '.$e->response->status(), $e->response->status());
        });

        return $req->json();
    }
}
