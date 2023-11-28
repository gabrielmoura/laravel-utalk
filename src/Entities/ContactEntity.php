<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class ContactEntity
{
    public string $lastActiveUTC;

    public string $phoneNumber;

    public ?string $profilePictureUrl;

    public bool $isOptIn;

    public bool $isBlocked;

    public array $scheduledMessages;

    public array $tags;

    public string $name;

    public string $id;

    public function __construct(array|object $data)
    {
        $this->lastActiveUTC = data_get($data, 'LastActiveUTC');
        $this->phoneNumber = data_get($data, 'PhoneNumber');
        $this->profilePictureUrl = data_get($data, 'ProfilePictureUrl');
        $this->isBlocked = data_get($data, 'IsBlocked');
        $this->isOptIn = data_get($data, 'IsOptIn');
        $this->scheduledMessages = data_get($data, 'ScheduledMessages');
        $this->tags = data_get($data, 'Tags');
        $this->name = data_get($data, 'Name');
        $this->id = data_get($data, 'Id');
    }
}
