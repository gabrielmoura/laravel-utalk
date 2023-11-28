<?php

namespace Gabrielmoura\LaravelUtalk;

//use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LaravelUtalkServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UtalkService::class, fn (Application $app) => new UtalkService());
    }

    public function boot(): void
    {
        $this->listenForEvents();
    }

    protected function listenForEvents()
    {
        $this->app['events']->listen([
            \Gabrielmoura\LaravelUtalk\Events\UtalkWebhookEvent::class,
        ]);
    }

    public function provides(): array
    {
        return [
            UtalkService::class,
        ];
    }
}
