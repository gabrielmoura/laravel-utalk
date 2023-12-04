<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Support\Collection;

class QuickAnswers extends UtalkBase
{
    /**
     * @description Cria uma nova resposta rápida
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $name Nome da resposta rápida
     * @param  bool  $visibilityAll Se true, a resposta rápida será visível para todos os operadores
     */
    public function set(string $organizationId, string $name, string $content, bool $visibilityAll = true): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->post('/quick-answers/', [
                'OrganizationId' => $organizationId,
                'Name' => $name,
                'Visibility' => $visibilityAll ? 'All' : 'Mine',
                'Content' => $content,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna todas as respostas rápidas
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     */
    public function getAll(string $organizationId, int $skip = 0, int $take = 31): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/quick-answers/', [
                'organizationId' => $organizationId,
                'Skip' => $skip,
                'Take' => $take,
                'Behavior' => 'CountAllAndGetSlice',
                'viewFrom' => 'Everyone',
                'OrderBy' => 'Name',
                'Order' => 'Asc',
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Deleta uma resposta rápida
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $quickAnswerId "AB_12-xyzEXAMPLE" ID da resposta rápida
     */
    public function delete(string $organizationId, string $quickAnswerId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->delete("/quick-answers/$quickAnswerId/", [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Retorna os detalhes de uma resposta rápida
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $quickAnswerId "AB_12-xyzEXAMPLE" ID da resposta rápida
     */
    public function get(string $organizationId, string $quickAnswerId): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get("/quick-answers/$quickAnswerId/", [
                'organizationId' => $organizationId,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
