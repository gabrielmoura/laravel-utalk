<?php

namespace Gabrielmoura\LaravelUtalk\Events;

use Gabrielmoura\LaravelUtalk\Entities\PayloadEvent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UtalkWebhookEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public PayloadEvent $payload;

    /**
     * Create a new event instance.
     */
    public function __construct(
        array $payload
    ) {
        $this->payload = new PayloadEvent($payload);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
