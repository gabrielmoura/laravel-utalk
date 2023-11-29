# Laravel Utalk

## Objetivo

Nesta versão, o propósito é estabelecer uma integração com o serviço de mensageria Utalk para o envio e recebimento de
mensagens. No entanto, as funcionalidades atualmente implementadas refletem apenas a utilização rudimentar da API.


### WebHook IPs

Caso sua aplicação esteja em um ambiente que necessite de liberação de IPs, utilize os seguintes IPs:

* 40.88.132.66
* 52.188.209.245

### Route WebHook

Certos webhooks retransmitem a mensagem se não receberem um código de resposta HTTP na faixa de 20x. Portanto, torna-se
essencial que a rota responsável pelo recebimento do webhook emita um código de sucesso antes de proceder ao tratamento
da mensagem recebida.

use /webhook/utalk ou webhook.utalk


### Send Message

```php
// Send Message
    $utalk = new UtalkService();
    $utalk->message()->set(
        fromPhone: '+55***********',
        toPhone: '+55***********',
        organizationId: '********',
        message: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    );
```

É encorajado a criação de um Listener para o evento de recebimento das mensagens pelo evento.

```php
<?php

namespace App\Listeners;

use Gabrielmoura\LaravelUtalk\Events\UtalkWebhookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UtalkMessageRcvListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UtalkWebhookEvent $event): void
    {
        if ($event->type == 'Message') {
            Log::debug("Mensagem Recebida", (array)$event);
        } else {
            Log::debug("Outro tipo de evento", (array)$event);
        }

    }
}
```

### Configurações

```php
/** config/services.php **/

'utalk' => [
        'key' => env('UTALK_KEY'),
        'organizationId'=>env('UTALK_ORGANIZATION_ID'),
        'channelId'=> env('UTALK_CHANNEL_ID'),
    ],
```

## Aviso de Responsabilidade e Colaboração para Desenvolvimento

Alertamos que o software pode conter imperfeições, erros ou bugs, os quais podem afetar o seu desempenho em determinadas
circunstâncias. Estamos empenhados em aprimorar continuamente este produto e contamos com a colaboração da comunidade de
usuários para a identificação e correção de eventuais problemas.

Caso você identifique qualquer erro, bug ou tenha sugestões para melhorias ou novas funcionalidades, encorajamos que
compartilhe conosco suas descobertas através de Pull Requests no repositório oficial. Acreditamos que a colaboração
mútua é essencial para a evolução do software e a criação de um ambiente mais robusto e confiável para todos os
usuários.

Agradecemos pela compreensão e pela sua contribuição para o aprimoramento contínuo deste projeto.

