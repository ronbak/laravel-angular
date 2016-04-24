<?php

namespace LaravelAngular\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelAngularRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \LaravelAngular\Repositories\ClientRepository::class,
            \LaravelAngular\Repositories\ClientRepositoryEloquent::class
        );
        $this->app->bind(
            \LaravelAngular\Repositories\ProjectRepository::class,
            \LaravelAngular\Repositories\ProjectRepositoryEloquent::class
        );
    }
}
