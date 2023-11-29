<?php

namespace Gabrielmoura\LaravelUtalk;

use Gabrielmoura\LaravelUtalk\Events\UtalkWebhookEvent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LaravelUtalkServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registra a classe de serviço
        $this->app->singleton(UtalkService::class, fn (Application $app) => new UtalkService());

        // Registra o facade
        $this->app->alias(Utalk::class, 'Utalk');
    }

    public function boot(): void
    {
        $this->listenForEvents();
    }

    protected function listenForEvents(): void
    {
        // Registra a rota para receber o webhook
        $this->app['router']->post('/webhook/utalk', function () {
            $req = request()->all();
            UtalkWebhookEvent::dispatch($req);

            return response()->noContent();
        })->name('webhook.utalk');
    }

    public function provides(): array
    {
        return [
            UtalkService::class,
        ];
    }
}
