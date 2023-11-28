<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class OrganizationsEntity
{
    public ?string $iconUrl;

    public array $permissions;

    public bool $active;

    public array $allowedSectors;

    public array $allowedChannels;

    public string $name;

    public string $id;

    public function __construct(array $data)
    {
        $this->iconUrl = data_get($data, 'iconUrl');
        $this->permissions = data_get($data, 'permissions');
        $this->active = data_get($data, 'active');
        $this->allowedSectors = data_get($data, 'allowedSectors');
        $this->allowedChannels = data_get($data, 'allowedChannels');
        $this->name = data_get($data, 'name');
        $this->id = data_get($data, 'id');
    }
}
