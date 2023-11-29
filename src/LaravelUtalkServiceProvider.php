<?php

namespace Gabrielmoura\LaravelUtalk;

//use Illuminate\Container\Container;
use Gabrielmoura\LaravelUtalk\Events\UtalkWebhookEvent;
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

    protected function listenForEvents(): void
    {
        $this->app['router']->post('/webhook/utalk', function () {
            $req = request()->all();
            UtalkWebhookEvent::dispatch($req);

            return response()->noContent();
        })->name('webhook.utalk');

        //        $this->app['events']->listen([
        //            UtalkWebhookEvent::class,
        //        ],[
        //            \Gabrielmoura\LaravelUtalk\Listeners\UtalkWebhookListener::class,
        //        ]);
    }

    public function provides(): array
    {
        return [
            UtalkService::class,
        ];
    }
}
