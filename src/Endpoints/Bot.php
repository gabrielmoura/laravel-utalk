<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Illuminate\Support\Collection;

class Bot extends UtalkBase
{
    /**
     * @description Cria um bot de Saudação
     *
     * @param  string  $title O título deste bot, apenas para referência interna
     * @param  string  $message A mensagem que será enviada
     * @param  array  $channelIds [AB_12-xyzEXAMPLE] IDs dos canais que receberão a mensagem
     * @param  string  $trigger ChatCreated|Manual A ação que disparará a mensagem
     * @param  int|null  $order A ordem em que este bot deve ser colocado ao lado de outros durante a execução
     * @param  bool  $final Quando verdadeiro, impedirá a execução de outros bots no canal se este bot decidir que deve executar
     */
    public function createGreeting(
        string $organizationId,
        string $title,
        string $message,
        array $channelIds,
        string $trigger = 'ChatCreated',
        int $order = null,
        bool $final = false
    ): Collection {
        if (strlen($title) <= 1) {
            throw new UtalkException('O título deve ter pelo menos 2 caracteres');
        }
        if (strlen($message) <= 1) {
            throw new UtalkException('A mensagem deve ter pelo menos 2 caracteres');
        }
        $req = $this->service
            ->refreshToken()
            ->post('/bots/greeting/', [
                'OrganizationId' => $organizationId,
                'Message' => $message,
                'ChannelIds' => $channelIds,
                'Trigger' => $trigger,
                'Title' => $title,
                'Order' => $order,
                'Final' => $final,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Cria um bot de Transferência de Setor
     *
     * @param  string  $organizationId O ID da organização
     * @param  string  $title O título deste bot, apenas para referência interna
     * @param  string  $body A mensagem que será enviada
     * @param  string  $prefix O prefixo que será enviado antes da mensagem
     * @param  array  $sectors [AB_12-xyzEXAMPLE] IDs dos possíveis setores que poderão ser transferidos
     * @param  array  $channelIds [AB_12-xyzEXAMPLE] IDs dos canais que receberão a mensagem
     * @param  string  $trigger ChatCreated|Manual A ação que disparará a mensagem
     * @param  int|null  $order A ordem em que este bot deve ser colocado ao lado de outros durante a execução
     * @param  bool  $final Quando verdadeiro, impedirá a execução de outros bots no canal se este bot decidir que deve executar
     */
    public function createSector(
        string $organizationId,
        string $title,
        string $body,
        string $prefix,
        array $sectors,
        array $channelIds,
        string $trigger = 'ChatCreated',
        int $order = null,
        bool $final = false
    ): Collection {
        $req = $this->service
            ->refreshToken()
            ->post('/bots/sector/', [
                'OrganizationId' => $organizationId,
                'Body' => $body,
                'Prefix' => $prefix,
                'Sectors' => $sectors,
                'ChannelIds' => $channelIds,
                'Trigger' => $trigger,
                'Title' => $title,
                'Order' => $order,
                'Final' => $final,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();

    }

    /**
     * @description Cria um bot Etiquetador
     *
     * @param  string  $organizationId O ID da organização
     * @param  string  $title O título deste bot, apenas para referência interna
     * @param  array  $channelIds [AB_12-xyzEXAMPLE] IDs dos canais que receberão a mensagem
     * @param  array  $tagIds [AB_12-xyzEXAMPLE] IDs das tags que receberão a mensagem
     * @param  string  $trigger ChatCreated|Manual A ação que disparará a mensagem
     * @param  int|null  $order A ordem em que este bot deve ser colocado ao lado de outros durante a execução
     * @param  bool  $final Quando verdadeiro, impedirá a execução de outros bots no canal se este bot decidir que deve executar
     */
    public function createTagging(
        string $organizationId,
        string $title,
        array $channelIds,
        array $tagIds,
        string $trigger = 'ChatCreated',
        int $order = null,
        bool $final = false
    ): Collection {
        $req = $this->service
            ->refreshToken()
            ->post('/bots/tagging/', [
                'OrganizationId' => $organizationId,
                'TagIds' => $tagIds,
                'ChannelIds' => $channelIds,
                'Trigger' => $trigger,
                'Title' => $title,
                'Order' => $order,
                'Final' => $final,
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();

    }

    /**
     * @description Deleta um bot
     *
     * @param  string  $organizationId O ID da organização
     * @param  string  $botId O ID do bot
     */
    public function delete(
        string $organizationId,
        string $botId
    ): Collection {
        $req = $this->service
            ->refreshToken()
            ->delete("/bots/$botId/", [
                'organizationId' => $organizationId,
            ]);

        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }
}
