<?php

namespace App\Providers;

use App\Repositories\AboutRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogRepository;
use App\Repositories\CareerRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\HeroSectionRepository;
use App\Repositories\Interfaces\AboutRepositoryInterface;
use App\Repositories\Interfaces\BlogCategoryRepositoryInterface;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\CareerRepositoryInterface;
use App\Repositories\Interfaces\GalleryRepositoryInterface;
use App\Repositories\Interfaces\HeroSectionRepositoryInterface;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Repositories\Interfaces\PartnerRepositoryInterface;
use App\Repositories\Interfaces\PortfolioCategoryRepositoryInterface;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\SiteSettingRepositoryInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\TestimonialRepositoryInterface;
use App\Repositories\Interfaces\WhyChooseUsRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\PortfolioCategoryRepository;
use App\Repositories\PortfolioRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SiteSettingRepository;
use App\Repositories\TeamRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\WhyChooseUsRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\Page;
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
        $this->app->bind(PartnerRepositoryInterface::class, PartnerRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
        $this->app->bind(CareerRepositoryInterface::class, CareerRepository::class);
        $this->app->bind(BlogCategoryRepositoryInterface::class, BlogCategoryRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(PortfolioCategoryRepositoryInterface::class, PortfolioCategoryRepository::class);
        $this->app->bind(PortfolioRepositoryInterface::class, PortfolioRepository::class);
        $this->app->bind(SiteSettingRepositoryInterface::class, SiteSettingRepository::class);
        $this->app->bind(HeroSectionRepositoryInterface::class, HeroSectionRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(AboutRepositoryInterface::class, AboutRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.frontend.*', function ($view) {

            $siteSetting = SiteSetting::first();

            $pages = Page::where('status', 1)
                ->orderBy('order_no')
                ->get();

            $view->with(compact('siteSetting', 'pages'));
        });
    }
}
