<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Support\Collection;

class Contact extends UtalkBase
{
    /**
     * @description Retorna todos os contatos de uma organização
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  bool  $includeGroups Se true, inclui os grupos do contato
     */
    public function getAll(string $organizationId, int $skip = 0, int $take = 25, bool $includeGroups = true): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/contacts/', [
                'organizationId' => $organizationId,
                'Skip' => $skip,
                'Take' => $take,
                'Behavior' => 'CountAllAndGetSlice',
                'Tags.Rule' => 'Any',
                'OrderBy' => 'Name',
                'Order' => 'Asc',
                'includeGroups' => $includeGroups,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna os chats de um contato
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $contactId "AB_12-xyzEXAMPLE"
     */
    public function getChats(string $organizationId, string $contactId, int $skip = 0, int $take = 25): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get("/contacts/$contactId/chats/", [
                'organizationId' => $organizationId,
                'Tags.Rule' => 'Any',
                'Members.Rule' => 'Any',
                'Channels.Rule' => 'Any',
                'Skip' => $skip,
                'Take' => $take,
                'Behavior' => 'CountAllAndGetSlice',
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna os dados de um contato
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $contactId "AB_12-xyzEXAMPLE"
     */
    public function get(string $organizationId, string $contactId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get("/contacts/$contactId/", [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna as anotações de um contato
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $contactId "AB_12-xyzEXAMPLE"
     */
    public function getNotes(string $organizationId, string $contactId): Collection
    {

        $req = $this->service
            ->refreshToken()
            ->get("/contacts/$contactId/notes/", [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
