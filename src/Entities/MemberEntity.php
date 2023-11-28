<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class MemberEntity
{
    public string $id;

    public array $organizations;

    public string $displayName;

    public string $emailAddress;

    public ?string $signature;

    public ?string $timeZone;

    public ?string $cellphone;

    public ?string $messageEndChat;

    public ?string $profilePictureUrl;

    public ?string $statusActivity;

    public ?string $umblerAccountId;

    public ?bool $muted;

    public ?array $permissions;

    public ?array $allowedSector;

    public ?array $allowedChannel;

    public ?bool $active;

    public ?string $lastBotTransferenceUTC;

    public ?string $_t;

    public ?string $createdAtUTC;

    public function __construct(array $data)
    {
        $this->displayName = data_get($data, 'displayName');
        $this->emailAddress = data_get($data, 'emailAddress');
        $this->signature = data_get($data, 'signature');
        $this->timeZone = data_get($data, 'timeZone');
        $this->cellphone = data_get($data, 'cellphone');
        $this->messageEndChat = data_get($data, 'messageEndChat');
        $this->profilePictureUrl = data_get($data, 'profilePictureUrl');
        $this->statusActivity = data_get($data, 'statusActivity');
        $this->umblerAccountId = data_get($data, 'umblerAccountId');
        $this->id = data_get($data, 'id');
        $this->createdAtUTC = data_get($data, 'createdAtUTC');

        foreach (data_get($data, 'organizations') as $organization) {
            $this->organizations[] = new OrganizationsEntity($organization);
        }

        $this->muted = data_get($data, 'muted');
        $this->permissions = data_get($data, 'permissions');
        $this->allowedSector = data_get($data, 'allowedSector');
        $this->allowedChannel = data_get($data, 'allowedChannel');
        $this->active = data_get($data, 'active');
        $this->lastBotTransferenceUTC = data_get($data, 'lastBotTransferenceUTC');
        $this->_t = data_get($data, '_t');
    }
}
