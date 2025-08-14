<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registre quaisquer serviços de aplicativo.
     */
    public function register(): void
    {
        // Registrando Repositories
        $this->app->bind(
            \App\Repositories\CategoryRepository::class,
            \App\Repositories\CategoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\ProductRepository::class,
            \App\Repositories\ProductRepository::class
        );

        $this->app->bind(
            \App\Repositories\CartRepository::class,
            \App\Repositories\CartRepository::class
        );

        // Registrando Services
        $this->app->bind(
            \App\Services\CategoryService::class,
            \App\Services\CategoryService::class
        );

        $this->app->bind(
            \App\Services\ProductService::class,
            \App\Services\ProductService::class
        );

        $this->app->bind(
            \App\Services\CartService::class,
            \App\Services\CartService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
