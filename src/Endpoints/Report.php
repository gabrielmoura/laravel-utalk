<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Validation\Validation;
use Illuminate\Support\Collection;

class Report extends UtalkBase
{
    /**
     * @description Retorna a quantidade de chats esperando
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     */
    public function getWaiting(string $organizationId): Collection
    {

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-waiting/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna a quantidade de chats abertos
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     */
    public function getOpened(string $organizationId): Collection
    {

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-opened/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna a quantidade de chats iniciadas por dia
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getByDate(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);
        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Tempo médio primeira resposta
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getFirstResponseTime(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);
        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-first-response-time/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Tempo médio finalizar atendimento
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getTimeToClose(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-time-to-close/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna por região
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getRegion(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-regions/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Membros
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getMember(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-members/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Setores
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getSector(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-sectors/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Etiquetas
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getTag(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-tags/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Top 20 contatos com mais chats
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     * @param  string|null  $memberId "AB_12-xyzEXAMPLE"
     * @param  string|null  $channelId "AB_12-xyzEXAMPLE"
     */
    public function getContact(string $organizationId, string $startDate, string $endDate, string $memberId = null, string $channelId = null): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);

        $req = $this->service
            ->refreshToken()
            ->get('/reports/chats-contact-most-chats/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'MemberId' => $memberId,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Avaliações por contato
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     */
    public function getContactRating(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/contact-ratings/repositories/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Avaliações por data
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24T19%3A32%3A27.7320000Z"
     * @param  string  $endDate "2023-12-01T19%3A32%3A27.7320000Z"
     */
    public function getContactRatingSimplified(string $organizationId, string $startDate, string $endDate): Collection
    {

        Validation::timestamp($startDate);
        Validation::timestamp($endDate);
        $req = $this->service
            ->refreshToken()
            ->get('/contact-ratings/simplified/', [
                'organizationId' => $organizationId,
                'startUTC' => $startDate,
                'endUTC' => $endDate,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna Avaliações por data
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $startDate "2023-11-24"
     * @param  string  $endDate "2023-12-01"
     * @param  string  $channelId "AB_12-xyzEXAMPLE"
     */
    public function conversationWindowsChatProjections(string $organizationId, string $startDate, string $endDate, string $channelId): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);
        $req = $this->service
            ->refreshToken()
            ->get('/reports/conversation-windows-chat-projections/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();

    }

    /**
     * @description Retorna projeções de janelas de conversa
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $startDate Data de inicio ISO 8601
     * @param  string  $endDate Data de fim ISO 8601
     * @param  string  $chatIds ID do chat
     * @param  string  $channelId ID do canal
     */
    public function conversationWindowsProjections(string $organizationId, string $startDate, string $endDate, string $chatIds, string $channelId): Collection
    {
        Validation::timestamp($startDate);
        Validation::timestamp($endDate);
        $req = $this->service
            ->refreshToken()
            ->get('/reports/conversation-windows-projections/', [
                'organizationId' => $organizationId,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'ChatIds' => $chatIds,
                'ChannelId' => $channelId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
