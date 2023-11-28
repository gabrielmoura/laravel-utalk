<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

use Gabrielmoura\LaravelUtalk\Entities\MessageEntity;
use Gabrielmoura\LaravelUtalk\Validation\Validation;
use Illuminate\Http\Client\RequestException;

class Message extends UtalkBase
{
    /**
     * @description Envia uma mensagem para um número de telefone
     *
     * @param  string  $toPhone "5511999999999" - Número de telefone do destinatário
     * @param  string  $fromPhone "5511999999999" - Número de telefone do remetente
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $message "Olá, tudo bem?"
     * @param  string|null  $file "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAGQCAYAAACzzXfZAAAgAElEQ…"
     * @param  bool  $skipReassign "false" - Se true, não reatribui a mensagem para um membro do chat
     *
     * @throws UtalkException
     */
    public function set(
        string $toPhone,
        string $fromPhone,
        string $organizationId,
        string $message,
        string $file = null,
        bool $skipReassign = false,
        string $token = null
    ): MessageEntity {
        Validation::numberPhone($toPhone);
        Validation::numberPhone($fromPhone);
        $req = $this->service
            ->refreshToken($token)
            ->post('/messages/simplified/', [
                'toPhone' => $toPhone,
                'fromPhone' => $fromPhone,
                'organizationId' => $organizationId,
                'message' => $message,
                'file' => $file,
                'skipReassign' => $skipReassign,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->getMessage(), $e->getCode());
        });

        return new MessageEntity($req->json());
    }

    /**
     * @description Retorna uma mensagem
     *
     * @param  string  $messageId "AB_12-xyzEXAMPLE"
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     */
    public function get(string $messageId, string $organizationId): MessageEntity
    {
        $req = $this->service
            ->refreshToken()
            ->post("/messages/$messageId/", [
                'organizationId' => $organizationId,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->getMessage(), $e->getCode());
        });

        return new MessageEntity($req->json());
    }

    /**
     * @description Envia uma mensagem para um chat
     *
     * @param  string  $organizationId "AB_12-xyzEXAMPLE"
     * @param  string  $chatId "AB_12-xyzEXAMPLE"
     * @param  string  $message "Olá, tudo bem?"
     * @param  bool  $isPrivate "false" - Se true, a mensagem será privada, não será enviada para o chat
     * @param  bool  $skipReassign "false" - Se true, não reatribui a mensagem para um membro do chat
     * @param  string|null  $prefix - Um prefixo a ser concatenado com a mensagem. Usado pelo aplicativo para incluir o nome da operadora. Não requerido
     * @param  string|null  $previousMessageId - O ID da mensagem anterior. Usado para criar uma cadeia de mensagens. Não requerido
     * @param  string|null  $replyToMessageId - O ID da mensagem a ser respondida. Usado para criar uma cadeia de mensagens. Não requerido
     * @param  string|null  $stickUrl - A URL do adesivo a ser enviado. Não requerido
     * @param  string|null  $tempId - O ID temporário da mensagem. Usado para criar uma cadeia de mensagens. Não requerido
     * @param  string|null  $file - O binário do arquivo a ser enviado. Não requerido
     */
    public function setComplete(
        string $organizationId,
        string $chatId,
        string $message,
        bool $isPrivate = false,
        bool $skipReassign = false,
        string $prefix = null,
        string $previousMessageId = null,
        string $replyToMessageId = null,
        string $stickUrl = null,
        string $tempId = null,
        string $file = null,
    ): MessageEntity {
        $req = $this->service
            ->refreshToken()
            ->post('/messages/', [
                'organizationId' => $organizationId,
                'chatId' => $chatId,
                'message' => $message,
                'isPrivate' => $isPrivate,
                'skipReassign' => $skipReassign,
                'prefix' => $prefix,
                'previousMessageId' => $previousMessageId,
                'replyToMessageId' => $replyToMessageId,
                'stickUrl' => $stickUrl,
                'tempId' => $tempId,
                'file' => $file,
            ]);
        $req->onError(function (RequestException $e) {
            throw new UtalkException($e->getMessage(), $e->getCode());
        });

        return new MessageEntity($req->json());
    }
}
