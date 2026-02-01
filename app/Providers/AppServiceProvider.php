<?php

namespace App\Providers;

use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
