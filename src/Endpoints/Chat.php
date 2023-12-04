<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Entities\ChatEntity;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class Chat extends UtalkBase
{
    /**
     * @description Busca um chat pelo id
     *
     * @param  string  $idChat Id do chat
     * @param  string  $organizationId Id da organização
     */
    public function get(string $idChat, string $organizationId): ChatEntity
    {
        $req = $this->service
            ->refreshToken()
            ->get("/chats/$idChat/", [
                'organizationId' => $organizationId,
                'includeMessages' => 0,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->response->json() ?? 'HTTP request returned status code '.$e->response->status(), $e->response->status());
        });

        return new ChatEntity($req->json());
    }

    /**
     * @description Busca chats
     *
     * @param  string  $organizationId Id da organização
     * @param  string  $searchText Texto para busca
     * @param  bool  $stateOpen Se true, busca chats abertos
     */
    public function search(string $organizationId, string $searchText, bool $stateOpen = true): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/chats/', [
                'organizationId' => $organizationId,
                'Sectors.Rule' => 'Any',
                'Searchtext' => $searchText,
                'ChatState' => $stateOpen ? 'Open' : 'Closed',
                'LastMessage' => 'All',
                'Order' => 'Desc',
                'Tags.Rule' => 'Any',
                'Members.Rule' => 'Any',
                'Channels.Rule' => 'Any',
                'Skip' => 0,
                'Take' => 0,
                'Behavior' => 'CountOnly',
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $this->transform(
            $req->json('items'),
            ChatEntity::class
        );
    }

    /**
     * @description Retorna todos os chats
     *
     * @param  string  $organizationId Id da organização
     */
    public function getAll(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/chats/', [
                'organizationId' => $organizationId,
                'Sectors.Rule' => 'Any',
                'Searchtext' => '',
                'ChatState' => 'Open',
                'LastMessage' => 'All',
                'Order' => 'Desc',
                'Tags.Rule' => 'Any',
                'Members.Rule' => 'Any',
                'Channels.Rule' => 'Any',
                'Skip' => 0,
                'Take' => 20,
                'Behavior' => 'GetSliceOnly',
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $this->transform(
            $req->json('items'),
            ChatEntity::class
        );
    }

    /**
     * @description Põe na fila de espera
     *
     * @param  string  $idChat Id do chat
     * @param  string  $organizationId Id da organização
     */
    public function setWaiting(string $idChat, string $organizationId): ChatEntity
    {
        $req = $this->service
            ->refreshToken()
            ->put("/chats/$idChat/?organizationId=$organizationId", [
                'Open' => null,
                'SectorId' => null,
                'MemberId' => null,
                'Private' => null,
                'Mute' => null,
                'Waiting' => true,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return new ChatEntity($req->json());
    }

    /**
     * @description Marca Chat como não lido
     *
     * @param  string  $idChat Id do chat
     * @param  string  $organizationId Id da organização
     */
    public function setUnread(string $idChat, string $organizationId): ChatEntity
    {
        $req = $this->service
            ->refreshToken()
            ->put("/chats/$idChat/unread/?organizationId=$organizationId", [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return new ChatEntity($req->json());
    }

    /**
     * @description Define Chat como privado
     *
     * @param  string  $organizationId Id da organização
     * @param  string  $memberId Id do membro
     * @param  string  $sectorId Id do setor
     */
    public function setPrivate(string $idChat, string $organizationId, string $memberId, string $sectorId): ChatEntity
    {
        $req = $this->service
            ->refreshToken()
            ->put("/chats/$idChat/?organizationId=$organizationId", [
                'Open' => true,
                'SectorId' => $sectorId,
                'MemberId' => $memberId,
                'Private' => true,
                'Mute' => null,
                'Waiting' => null,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return new ChatEntity($req->json());
    }

    /**
     * @description Define Chat como público
     *
     * @param  string  $organizationId Id da organização
     * @param  string  $memberId Id do membro
     * @param  string  $sectorId Id do setor
     */
    public function setRelease(string $idChat, string $organizationId, string $memberId, string $sectorId): ChatEntity
    {
        $req = $this->service
            ->refreshToken()
            ->put("/chats/$idChat/?organizationId=$organizationId", [
                'Open' => true,
                'SectorId' => $sectorId,
                'MemberId' => $memberId,
                'Private' => false,
                'Mute' => null,
                'Waiting' => null,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return new ChatEntity($req->json());
    }

    /**
     * @description Busca os chats começados pelos clientes
     *
     * @param  string  $organizationId Id da organização
     * @param  string  $channelId Id do canal
     * @param  string  $memberId Id do membro
     * @param  string  $sectorId Id do setor
     */
    public function closeSession(string $idChat, string $organizationId, string $channelId, string $memberId, string $sectorId): ChatEntity
    {
        $req = $this->service
            ->refreshToken()
            ->put("/chats/$idChat/?organizationId=$organizationId", [
                //                'includeMessages' => 0,
                'open' => false,
                'private' => true,
                'mute' => true,
                'channelId' => $channelId,
                'memberId' => $memberId,
                'sectorId' => $sectorId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return new ChatEntity($req->json());
    }

    /**
     * @description Busca os chats começados pelos clientes e não lidos
     *
     * @param  string  $idChat Id do chat
     * @param  string  $organizationId Id da organização
     * @return Collection<int,ChatEntity>
     */
    public function getUnread(string $idChat, string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/chats/', [
                'organizationId' => $organizationId,
                'ChatState' => 'Open',
                'LastMessage' => 'Contact',
                'Order' => 'Desc',
                'Skip' => 0,
                'Take' => 50,
                'Behavior' => 'GetSliceOnly',
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $this->transform(
            $req->json('items'),
            ChatEntity::class
        );
    }
}
