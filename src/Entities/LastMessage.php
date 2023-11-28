<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class LastMessage
{
    public ?string $prefix;

    public ?string $content;

    public ?array $contacts;

    /**
     * @description Tipo da mensagem
     *
     * @var string  (Sticker|Text|Contact|Location|Image|Sticker)
     */
    public string $messageType;

    public ?array $sentByOrganizationMember;

    public bool $isPrivate;

    /**
     * @description Remetente da mensagem
     *
     * @var string (Contact|Member|External)
     */
    public string $source;

    /**
     * @description Estado da mensagem
     *
     * @var string  (Processing|Read)
     */
    public string $messageState;

    public string $eventAtUTC;

    public array $chat;

    public array $buttons;

    public string $id;

    public string $createdAtUTC;

    public ?array $inReplay;

    public ?array $fromContact;

    public function __construct(array|object $data)
    {
        $this->prefix = data_get($data, 'Prefix', null);
        $this->content = data_get($data, 'Content');
        $this->contacts = data_get($data, 'Contacts');
        $this->messageType = data_get($data, 'MessageType');
        $this->sentByOrganizationMember = data_get($data, 'SentByOrganizationMember');
        $this->isPrivate = data_get($data, 'IsPrivate');
        $this->source = data_get($data, 'Source');
        $this->messageState = data_get($data, 'MessageState');
        $this->eventAtUTC = data_get($data, 'EventAtUTC');
        $this->buttons = data_get($data, 'Buttons');
        $this->id = data_get($data, 'Id');
        $this->createdAtUTC = data_get($data, 'CreatedAtUTC');
        foreach (data_get($data, 'Chat') as $chat) {
            $this->chat[] = $chat;
        }
        $this->inReplay = data_get($data, 'InReplay');
        $this->fromContact = data_get($data, 'FromContact');
    }

    /**
     * Retorna o remetente da mensagem (Contact|Member)
     *
     * @return string (Contact|Member)
     */
    public function getSource(): string
    {
        return $this->source;
    }
}
