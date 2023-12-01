<?php

namespace Gabrielmoura\LaravelUtalk;

use Gabrielmoura\LaravelUtalk\Endpoints\ActivityLogs;
use Gabrielmoura\LaravelUtalk\Endpoints\Channel;
use Gabrielmoura\LaravelUtalk\Endpoints\Chat;
use Gabrielmoura\LaravelUtalk\Endpoints\Contact;
use Gabrielmoura\LaravelUtalk\Endpoints\Member;
use Gabrielmoura\LaravelUtalk\Endpoints\Message;
use Gabrielmoura\LaravelUtalk\Endpoints\OrganizationInvites;
use Gabrielmoura\LaravelUtalk\Endpoints\Report;
use Gabrielmoura\LaravelUtalk\Endpoints\Sector;
use Gabrielmoura\LaravelUtalk\Endpoints\Webhook;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @method Channel channel() Channel
 * @method Member member() Member
 * @method Message message() Message
 * @method Sector sector() Sector
 * @method Webhook webhook() Webhook
 * @method Chat chat() Chat
 * @method ActivityLogs activityLog() ActivityLog
 * @method OrganizationInvites organizationInvites() OrganizationInvites
 * @method Report report() Report
 * @method Contact contact() Contact
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
