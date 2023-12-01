<?php

namespace Gabrielmoura\LaravelUtalk\Entities;

class Tag
{
    public string $_t;

    public ?string $name;

    public ?string $emoji;

    public ?string $color;

    public ?int $order;

    public ?string $createdAtUTC;

    /**
     * @phpstan-param array{ _t: string, name: string, emoji: string, color: string, order: int, createdAtUTC: string } $data
     */
    public function __construct(array|object $data)
    {
        $this->_t = data_get($data, '_t');
        $this->name = data_get($data, 'name');
        $this->emoji = data_get($data, 'emoji');
        $this->color = data_get($data, 'color');
        $this->order = data_get($data, 'order');
        $this->createdAtUTC = data_get($data, 'createdAtUTC');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            '_t' => $this->_t,
            'name' => $this->name,
            'emoji' => $this->emoji,
            'color' => $this->color,
            'order' => $this->order,
            'createdAtUTC' => $this->createdAtUTC,
        ];
    }
}
