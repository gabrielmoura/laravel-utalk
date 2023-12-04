<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Support\Collection;

class Webhook extends UtalkBase
{
    /**
     * @description Retorna os webhooks
     *
     * @param  string  $organizationId ID da organização
     */
    public function get(string $organizationId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/webhooks/', [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Atribui um webhook
     *
     * @param  string  $organizationId ID da organização
     * @param  string  $name Nome do webhook
     * @param  string  $url URL do webhook
     * @param  array  $channelIds IDs dos canais
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
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Atribui este servidor como webhook
     *
     * @throws UtalkException
     */
    public function setMe(): Collection
    {
        $route = route('webhook.utalk');
        if (! $route) {
            throw new UtalkException('Route webhook.utalk not found');
        }
        $organizationId = config('services.utalk.organization_id');
        if (! $organizationId) {
            throw new UtalkException('Organization ID not found');
        }
        $name = 'Webhook Laravel Utalk';
        $channelIds = [config('services.utalk.channel_id')];
        if (! $channelIds[0]) {
            throw new UtalkException('Channel ID not found');
        }

        return $this->set($organizationId, $name, $route, $channelIds);
    }

    /**
     * @description Retorna os IPs dos webhooks
     *
     * @throws UtalkException
     */
    public function getIpList(): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/webhooks/ranges/');
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
