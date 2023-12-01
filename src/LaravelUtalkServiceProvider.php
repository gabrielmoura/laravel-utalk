<?php

namespace Gabrielmoura\LaravelUtalk;

use Gabrielmoura\LaravelUtalk\Events\UtalkWebhookEvent;
use Gabrielmoura\LaravelUtalk\middleware\RestrictIPMiddleware;
use Gabrielmoura\LaravelUtalk\Notification\UtalkChannel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelUtalkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registra a classe de serviço
        $this->app->singleton(UtalkService::class, fn (Application $app) => new UtalkService());

        // Registra o facade
        $this->app->alias(Utalk::class, 'Utalk');
    }

    public function boot(): void
    {
        $this->registerRouteMacros();
    }

    protected function listenForEvents(): static
    {
        // Registra a rota para receber o webhook
        $this->app['router']->post('/webhook/utalk', function () {
            $req = request()->all();
            UtalkWebhookEvent::dispatch($req);

            return response()->noContent();
        })->middleware(RestrictIPMiddleware::class)
            ->name('webhook.utalk');

        return $this;
    }

    protected function registerRouteMacros(): static
    {
        // Registra Macro para receber WebHook.
        Route::macro('utalk', function (string $baseUrl = 'webhook') {
            Route::post('utalk', function () {
                $req = request()->all();
                UtalkWebhookEvent::dispatch($req);

                return response()->noContent();
            })
                ->prefix($baseUrl)
                ->middleware(RestrictIPMiddleware::class)
                ->name('webhook.utalk');
        });

        return $this;
    }

    /**
     * @return $this
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function registerNotificationChannels(): static
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('utalk', fn ($app) => $this->app->make(UtalkChannel::class));
        });

        return $this;
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            UtalkService::class,
        ];
    }
}
