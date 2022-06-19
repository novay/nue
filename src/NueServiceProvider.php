<?php

namespace Novay\Nue;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NueServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nue');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        
        $this->registerConfig();
        $this->configurePublishing();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\NueCommand::class,
                Commands\InstallCommand::class,
                Commands\AuthCommand::class,
            ]);
        }

        $this->app->singleton('notify', function ($app) {
            return $this->app->make('Novay\Nue\Services\Notifier');
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nue.php', 'nue');

        $this->publishes([__DIR__.'/../config' => config_path()], 'nue-config');
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../database/migrations/2014_10_12_000000_create_users_table.php' => database_path('migrations/2014_10_12_000000_create_users_table.php'),
        ], 'nue-migrations');


    }
}
