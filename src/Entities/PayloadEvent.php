<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class PayloadEvent
{
    /**
     * @description Tipo da Notificação
     */
    public string $type;

    private $rawContent;

    public ?string $eventId;

    public ?string $eventDate;

    public array $organization;

    public $contact;

    public $channel;

    public $sector;

    public $organizationMembers;

    public ?LastMessage $lastMessage;

    public $open;

    public $private;

    public $waiting;

    public $unread;

    public $eventAtUTC;

    public $id;

    public $createdAtUTC;

    public function __construct($payload)
    {
        $this->type = data_get($payload, 'Type');
        $this->rawContent = data_get($payload, 'Payload.Content');
        $this->eventId = data_get($payload, 'EventId');
        $this->eventDate = data_get($payload, 'EventDate');

        foreach (data_get($this->rawContent, 'Organization') as $organization) {
            $this->organization[] = $organization;
        }

        $this->contact = new ContactEntity(data_get($this->rawContent, 'Contact'));
        $this->channel = new ChannelEntity(data_get($this->rawContent, 'Channel'));
        $this->sector = new SectorEntity(data_get($this->rawContent, 'Sector'));

        $this->organizationMembers = data_get($this->rawContent, 'OrganizationMembers');

        $this->lastMessage = data_get($this->rawContent, 'LastMessage') ? new LastMessage(data_get($this->rawContent, 'LastMessage')) : null;

        $this->open = data_get($this->rawContent, 'Open');
        $this->private = data_get($this->rawContent, 'Private');
        $this->waiting = data_get($this->rawContent, 'Waiting');
        $this->unread = data_get($this->rawContent, 'Unread');
        $this->eventAtUTC = data_get($this->rawContent, 'EventAtUTC');
        $this->id = data_get($this->rawContent, 'Id');
        $this->createdAtUTC = data_get($this->rawContent, 'CreatedAtUTC');

    }
}
