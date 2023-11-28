<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class SectorEntity
{
    public ?string $_t;

    public string $id;

    public string $name;

    public bool $default;

    public int $order;

    public function __construct(array|object $data)
    {
        $this->_t = data_get($data, '_t');
        $this->id = data_get($data, 'id') ?? data_get($data, 'Id');
        $this->name = data_get($data, 'name') ?? data_get($data, 'Name');
        $this->default = data_get($data, 'default') ?? data_get($data, 'Default');
        $this->order = data_get($data, 'order') ?? data_get($data, 'Order');
    }
}
