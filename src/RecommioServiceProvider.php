<?php

namespace Roboticsexpert\Recommio;

use Illuminate\Support\ServiceProvider;


class RecommioServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/recommio.php' => config_path('recommio.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(Recommio::class, function ($app) {
            if (empty(config('recommio.base_url')))
                throw new \UnexpectedValueException('you should fill base url for recommio');
            if (empty(config('recommio.token')))
                throw new \UnexpectedValueException('you should fill token for recommio');
            return new Recommio(config('recommio.base_url'), config('recommio.token'));
        });

        $this->app->singleton(RecommioGraph::class, function ($app) {
            if (empty(config('recommio.base_url')))
                throw new \UnexpectedValueException('you should fill base url for recommio');
            if (empty(config('recommio.token')))
                throw new \UnexpectedValueException('you should fill token for recommio');
            return new RecommioGraph(config('recommio.base_url'), config('recommio.token'));
        });
    }

    public function provides()
    {
        return [
            Recommio::class,
            RecommioGraph::class
        ];
    }

}
