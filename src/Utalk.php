<?php

namespace Gabrielmoura\LaravelUtalk;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @method channel() Channel
 * @method member() Member
 * @method message() Message
 * @method sector() Sector
 * @method webhook() Webhook
 * @method chat() Chat
 * @method activityLog() ActivityLog
 * @method organizationInvites() OrganizationInvites
 * @method withToken(string $token)
 * @method refreshToken(string $token = null)
 * @method PendingRequest api()
 *
 * @see UtalkService
 */
class Utalk extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UtalkService::class;
    }
}
