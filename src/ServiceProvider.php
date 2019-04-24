<?php

namespace PrimitiveSocial\NestioApiWrapper;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

    }

    protected function bootForConsole()
    {

        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/nestio.php' => config_path('nestio.php'),
        ], 'nestio.config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Bind any implementations.
        $this->mergeConfigFrom(__DIR__.'/../config/nestio.php', 'nestio');

        // Register the service the package provides.
        $this->app->singleton('nestioapiwrapper', function ($app) {
            return new Nestio;
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return ['nestioapiwrapper'];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/nestio.php';

        $this->publishes([$configPath => config_path('nestio.php')]);

        $this->mergeConfigFrom($configPath, 'nestio');
    }

}
