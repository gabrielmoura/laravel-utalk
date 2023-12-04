<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Validation\Validation;
use Illuminate\Support\Collection;

class ScheduledMessage extends UtalkBase
{
    /**
     * @description Retorna todas as mensagens agendadas
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $contactId "AB_12-xyzEXAMPLE" ID do contato
     */
    public function getAll(string $organizationId, string $contactId, int $skip = 0, int $take = 31): Collection
    {
        $req = $this->service
            ->refreshToken()
            ->get('/scheduled-messages/', [
                'organizationId' => $organizationId,
                'contactId' => $contactId,
                'Skip' => $skip,
                'Take' => $take,
                'Behavior' => 'GetSliceOnly',
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();
    }

    /**
     * @description Cria uma nova mensagem agendada
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE" ID da organização
     * @param  string  $contactId "AB_12-xyzEXAMPLE" ID do contato
     * @param  string  $message Mensagem a ser enviada
     * @param  string  $dateSendAtUTC Data de envio da mensagem
     * @param  string|null  $channelId ID do canal
     * @param  string|null  $prefix Prefixo da mensagem
     */
    public function set(string $organizationId, string $contactId, string $message, string $dateSendAtUTC, string $channelId = null, string $prefix = null): Collection
    {
        Validation::timestamp($dateSendAtUTC);
        $req = $this->service
            ->refreshToken()
            ->post('/scheduled-messages/', [
                'DateSendAtUTC' => $dateSendAtUTC,
                'Message' => $message,
                'OrganizationId' => $organizationId,
                'ChannelId' => $channelId,
                'ContactId' => $contactId,
                'TemplateId' => null,
                'BotId' => null,
                'BotTriggerName' => null,
                'BotName' => null,
                'Prefix' => $prefix,
                'Params' => [],
            ]);
        $req->onError(fn ($e) => $this->error($e));

        return $req->collect();

    }
}
