<?php

namespace Gabrielmoura\LaravelUtalk;

use Gabrielmoura\LaravelUtalk\Endpoints\HasActivityLog;
use Gabrielmoura\LaravelUtalk\Endpoints\HasChannel;
use Gabrielmoura\LaravelUtalk\Endpoints\HasChat;
use Gabrielmoura\LaravelUtalk\Endpoints\HasMember;
use Gabrielmoura\LaravelUtalk\Endpoints\HasMessage;
use Gabrielmoura\LaravelUtalk\Endpoints\HasOrganizationInvites;
use Gabrielmoura\LaravelUtalk\Endpoints\HasSector;
use Gabrielmoura\LaravelUtalk\Endpoints\HasWebhook;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Class UtalkService
 *
 * @property PendingRequest $api
 * @property string $version
 *
 * @description This class is a service to connect with UTalk API
 *
 * @url https://app-utalk.umbler.com/api/v1/
 * @url https://app-utalk.umbler.com/api/docs/index.html
 *
 * @method PendingRequest withToken(string $token)
 */
class UtalkService
{
    use HasActivityLog;
    use HasChannel;
    use HasChat;
    use HasMember;
    use HasMessage;
    use HasOrganizationInvites;
    use HasSector;
    use HasWebhook;

    public PendingRequest $api;

    protected string $version = 'v1';

    public function __construct()
    {
        $this->api = Http::baseUrl("https://app-utalk.umbler.com/api/$this->version/")
            ->acceptJson()
            ->contentType('application/json');

    }

    public function refreshToken(string $token = null): PendingRequest
    {
        $this->api->withToken($token ?? config('services.utalk.key'));

        return $this->api;
    }
}
