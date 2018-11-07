<?php

namespace Vetor\Laravel\Collect\Providers;

use Illuminate\Support\ServiceProvider;
use Vetor\Laravel\Collect\Collection\Models\Collection;
use Vetor\Contracts\Collect\Collection\Models\Collection as CollectionContract;
use Vetor\Laravel\Collect\Collectable\Services\CollectableService;
use Vetor\Contracts\Collect\Collectable\Services\CollectableService as CollectableServiceContract;

class CollectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerContracts();
    }

    public function registerContracts()
    {
        $this->app->bind(CollectionContract::class, Collection::class);
        $this->app->bind(CollectableServiceContract::class, CollectableService::class);
    }

    /**
     * Register the Love migrations.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}
