<?php

namespace App\Providers;

use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\TestimonialRepositoryInterface;
use App\Repositories\Interfaces\WhyChooseUsRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\TeamRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\WhyChooseUsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, TestimonialRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(WhyChooseUsRepositoryInterface::class, WhyChooseUsRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
