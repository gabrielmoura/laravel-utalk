<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Validation\Validation;
use Illuminate\Support\Collection;

class ScheduledMessage extends UtalkBase
{
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
