<?php

namespace Gabrielmoura\LaravelUtalk;

use Gabrielmoura\LaravelUtalk\Traits\HasActivityLog;
use Gabrielmoura\LaravelUtalk\Traits\HasBot;
use Gabrielmoura\LaravelUtalk\Traits\HasChannel;
use Gabrielmoura\LaravelUtalk\Traits\HasChat;
use Gabrielmoura\LaravelUtalk\Traits\HasContact;
use Gabrielmoura\LaravelUtalk\Traits\HasMember;
use Gabrielmoura\LaravelUtalk\Traits\HasMessage;
use Gabrielmoura\LaravelUtalk\Traits\HasNotification;
use Gabrielmoura\LaravelUtalk\Traits\HasOrganizationInvites;
use Gabrielmoura\LaravelUtalk\Traits\HasQuickAnswers;
use Gabrielmoura\LaravelUtalk\Traits\HasReport;
use Gabrielmoura\LaravelUtalk\Traits\HasScheduledMessage;
use Gabrielmoura\LaravelUtalk\Traits\HasSector;
use Gabrielmoura\LaravelUtalk\Traits\HasWebhook;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Class UtalkServiceFake
 *
 * @property PendingRequest $api
 * @property string $version
 *
 * @description This class is a service to connect with UTalk API Fake
 *
 * @url https://app-utalk.umbler.com/api/v1/
 * @url https://app-utalk.umbler.com/api/docs/index.html
 *
 * @method PendingRequest withToken(string $token)
 */
class UtalkServiceFake
{
    use HasActivityLog;
    use HasBot;
    use HasChannel;
    use HasChat;
    use HasContact;
    use HasMember;
    use HasMessage;
    use HasNotification;
    use HasOrganizationInvites;
    use HasQuickAnswers;
    use HasReport;
    use HasScheduledMessage;
    use HasSector;
    use HasWebhook;

    public PendingRequest|Factory $api;

    protected string $version = 'v1';

    public function __construct()
    {
        $this->api = Http::fake([
            '*/messages/simplified/' => Http::response([
                'prefix' => null,
                'headerContent' => null,
                'content' => 'ola mundo1',
                'footer' => null,
                'file' => null,
                'thumbnail' => null,
                'contacts' => [],
                'messageType' => 'Text',
                'sentByOrganizationMember' => [
                    'muted' => false,
                    'id' => 'ZWXf2XNMPs-uxEe_',
                ],
                'isPrivate' => false,
                'location' => null,
                'question' => null,
                'source' => 'Member',
                'inReplyTo' => null,
                'messageState' => 'Processing',
                'eventAtUTC' => '2023-11-28T13:13:26.760188Z',
                'chat' => [
                    'id' => 'ZWXilm9TESTE',
                ],
                'fromContact' => null,
                'templateId' => null,
                'buttons' => [],
                'botInstance' => null,
                'forwardedFrom' => null,
                'scheduledMessage' => null,
                'bulkSendSession' => null,
                'contactId' => 'ZWXilm9oq3CzSlSh',
                'id' => 'ZWXndnNMPs-teste',
                'createdAtUTC' => '2023-11-28T13:13:26.7601879Z',
            ]),
            '*/channels' => Http::response([
                [
                    'phoneNumber' => '+552199999999',
                    'appName' => 'welcomer-e2653d78-9fef-4433-a652-0249e964ee31',
                    'appId' => 'welcomer-e2653d78-9fef-4433-a652-0249e964ee31',
                    'channelType' => 'Welcomer',
                    'platform' => null,
                    'state' => 'Live',
                    'name' => 'Boas vindas',
                    'id' => 'ZWXf2m9oq3CzSFZg',
                ],
                [
                    'phoneNumber' => '+552199999999',
                    'appName' => 'orc-wmbkvtkz',
                    'appId' => 'orc-wmbkvtkz',
                    'channelType' => 'WhatsappBroker',
                    'platform' => 'StarterV2',
                    'state' => 'Live',
                    'name' => 'Atendimento Gabriel Moura',
                    'id' => 'ZWXf2nNMPs-uxEsW',
                ],
            ]),
            '*/chats/*' => Http::response([
                'hasMessagesBeforeAllowedHistory' => false,
                'latestMessages' => [],
                'organization' => [
                    'id' => 'ZWXf2VBBVTESTE123',
                ],
                'contact' => [
                    'lastActiveUTC' => '2023-11-18T19:09:44.213Z',
                    'phoneNumber' => '+552199999999',
                    'profilePictureUrl' => 'https://utalk-wamedia.s3.amazonaws.com/ZWXf2VBBVTESTE123/foto_n.jpg',
                    'isOptIn' => true,
                    'isBlocked' => false,
                    'scheduledMessages' => [],
                    'groupIdentifier' => null,
                    'tags' => [],
                    'name' => '+55 21 99187-7221',
                    'id' => 'ZWXilm9oq3CzSlSh',
                ],
                'channel' => [
                    'phoneNumber' => '+552199999999',
                    'appName' => 'orc-wmbkvtkz',
                    'appId' => 'orc-wmbkvtkz',
                    'channelType' => 'WhatsappBroker',
                    'platform' => 'StarterV2',
                    'state' => 'Live',
                    'name' => 'Atendimento Gabriel Moura',
                    'id' => 'ZWXf2nNMPs-uxEsW',
                ],
                'sector' => [
                    'default' => true,
                    'order' => 0,
                    'name' => 'Geral',
                    'id' => 'ZWXf2VBBVVuOeMOU',
                ],
                'organizationMember' => [
                    'muted' => false,
                    'id' => 'ZWXf2XNMPs-uxEe_',
                ],
                'organizationMembers' => [
                    0 => [
                        'muted' => false,
                        'id' => 'ZWXf2XNMPs-uxEe_',
                    ],
                ],
                'tags' => [],
                'lastMessage' => [
                    'prefix' => null,
                    'headerContent' => null,
                    'content' => 'ola mundo1',
                    'footer' => null,
                    'file' => null,
                    'thumbnail' => null,
                    'contacts' => [],
                    'messageType' => 'Text',
                    'sentByOrganizationMember' => [
                        'muted' => false,
                        'id' => 'ZWXf2XNMPs-uxEe_',
                    ],
                    'isPrivate' => false,
                    'location' => null,
                    'question' => null,
                    'source' => 'Member',
                    'inReplyTo' => null,
                    'messageState' => 'Read',
                    'eventAtUTC' => '2023-11-28T13:13:26.76Z',
                    'chat' => [
                        'id' => 'ZWXilm9TESTE',
                    ],
                    'fromContact' => null,
                    'templateId' => null,
                    'buttons' => [],
                    'botInstance' => null,
                    'forwardedFrom' => null,
                    'scheduledMessage' => null,
                    'bulkSendSession' => null,
                    'contactId' => null,
                    'id' => 'ZWXndnNMPs-teste',
                    'createdAtUTC' => '2023-11-28T13:13:26.76Z',
                ],
                'redactReason' => null,
                'open' => true,
                'private' => false,
                'waiting' => false,
                'waitingSinceUTC' => null,
                'unread' => [],
                'closedAtUTC' => null,
                'eventAtUTC' => '2023-11-28T13:13:26.76Z',
                'firstMemberReplyMessage' => null,
                'bots' => [],
                'id' => 'ZWXilm9TESTE',
                'createdAtUTC' => '2023-11-28T12:52:38.24Z',
            ]),
            '*/members/me/' => Http::response([
                'displayName' => 'Gabriel Moura',
                'emailAddress' => 'gmoura96@apple.spam',
                'signature' => null,
                'cellphone' => '+552199999999',
                'messageEndChat' => null,
                'profilePictureUrl' => null,
                'organizations' => [
                    [
                        'iconUrl' => null,
                        'permissions' => [
                            'Member',
                            'Operator',
                            'Admin',
                            'Owner',
                        ],
                        'active' => true,
                        'allowedSectors' => [
                            'allSectorsEnable' => true,
                            'sectors' => [],
                        ],
                        'allowedChannels' => [
                            'allChannelsEnable' => true,
                            'channels' => [],
                        ],
                        'name' => 'Devs Ltda',
                        'id' => 'ZWXf2VBBVTESTE123',
                    ],
                ],
                'umblerAccountId' => 'ZWXf0zNT_-gUc6g0',
                'id' => 'ZWXf2XNMPs-uxEe_',
                'createdAtUTC' => '2023-11-28T12:40:57.555Z',
            ]),
            '*/sectors/*' => Http::response([
                [
                    'default' => true,
                    'order' => 0,
                    'name' => 'Geral',
                    'id' => 'ZWXf2VBBVVuOeMOU',
                ],
            ]),
            '*/webhooks/*' => Http::response([]),
        ])->baseUrl("https://app-utalk.umbler.com/api/$this->version/")
            ->acceptJson()
            ->contentType('application/json');

    }

    public function refreshToken(string $token = null): PendingRequest
    {
        $this->api->withToken($token ?? config('services.utalk.key'));

        return $this->api;
    }
}
