<?php

namespace Gabrielmoura\LaravelUtalk\Notification;

use Gabrielmoura\LaravelUtalk\Endpoints\UtalkException;
use Gabrielmoura\LaravelUtalk\Entities\MessageEntity;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Notification;

class UtalkChannel
{
    private Dispatcher $dispatcher;

    /**
     * Channel constructor.
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function send(mixed $notifiable, Notification $notification): ?MessageEntity
    {
        if (method_exists($notifiable, 'routeNotificationForUtalk')) {
            $id = $notifiable->routeNotificationForUtalk($notifiable);
        } else {
            $id = $notifiable->getKey();
        }

        // @phpstan-ignore-next-line
        $data = method_exists($notification, 'toUtalk') ? $notification->toUtalk($notifiable) : $notification->toArray($notifiable);

        if (empty($data)) {
            return null;
        }

        if (! isset($data['to_phone']) && ! isset($data['message'])) {
            return null;
        }
        $talk = app('Utalk')->message();
        try {

            $response = app('Utalk')->message()->set(
                toPhone: $data['to_phone'],
                fromPhone: $data['from_phone'] ?? config('services.utalk.from_phone'),
                organizationId: $data['organization_id'] ?? config('services.utalk.organization_id'),
                message: $data['message']
            );

        } catch (UtalkException $exception) {
            $this->dispatcher->dispatch(new NotificationFailed($notifiable, $notification, 'utalk', [
                'to' => $data['to_phone'],
                'request' => $data,
                'exception' => $exception,
            ]));

            throw $exception;
        }

        return $response;
    }
}
