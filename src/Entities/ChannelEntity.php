<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class ChannelEntity
{
    public string $phoneNumber;

    public string $state;

    public string $channelType;

    public ?string $platform;

    public string $name;

    public string $id;

    public function __construct(array|object $data)
    {
        $this->phoneNumber = data_get($data, 'phoneNumber') ?? data_get($data, 'PhoneNumber');
        $this->state = data_get($data, 'state') ?? data_get($data, 'State');
        $this->channelType = data_get($data, 'channelType') ?? data_get($data, 'ChannelType');
        $this->platform = data_get($data, 'platform') ?? data_get($data, 'Platform');
        $this->name = data_get($data, 'name') ?? data_get($data, 'Name');
        $this->id = data_get($data, 'id') ?? data_get($data, 'Id');
    }
}
