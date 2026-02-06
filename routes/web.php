<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\HeroSectionController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PortfolioCategoryController;
use App\Http\Controllers\Backend\PortfolioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\{
    BlogController,
    BlogCategoryController,
    DashboardController,
    FaqController,
    GalleryController,
    PartnerController,
    ServiceController,
    SiteSettingController,
    TeamController,
    WhyChooseUsController,
    TestimonialController,
    CareerController
};

# Frontend Routes
Route::get('/', [FrontendController::class, 'indexHome'])->name('web.home');
Route::get('/contact', [FrontendController::class, 'indexContact'])->name('web.contact');
Route::get('/career', [FrontendController::class, 'indexCareer'])->name('web.career');
Route::get('/project', [FrontendController::class, 'indexPortfolio'])->name('web.portfolio');
Route::get('/about', [FrontendController::class, 'indexAbout'])->name('web.about');
Route::get('/team', [FrontendController::class, 'indexTeam'])->name('web.team');
Route::get('/blog', [FrontendController::class, 'indexBlog'])->name('web.blog');
Route::get('/testimonial', [FrontendController::class, 'indexTestimonial'])->name('web.testimonial');
Route::get('/services', [FrontendController::class, 'indexService'])->name('web.services');
Route::get('/gallery', [FrontendController::class, 'indexGallery'])->name('web.gallery');

# Authentication Routes
Auth::routes();

# Home & Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('profile', [DashboardController::class, 'indexProfile'])
        ->name('profile.index');

    Route::get('profile/edit', [DashboardController::class, 'editProfile'])
        ->name('profile.edit');

    Route::put('profile/update', [DashboardController::class, 'updateProfile'])
        ->name('profile.update');

});

# Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    # Standard resource controllers with bulk-destroy and toggle-status
    $resources = [
        'blogs' => BlogController::class,
        'blog-categories' => BlogCategoryController::class,
        'portfolio-categories' => PortfolioCategoryController::class,
        'portfolios' => PortfolioController::class,
        'partners' => PartnerController::class,
        'galleries' => GalleryController::class,
        'services' => ServiceController::class,
        'why_choose_us' => WhyChooseUsController::class,
        'testimonials' => TestimonialController::class,
        'teams' => TeamController::class,
        'faqs' => FaqController::class,
        'careers' => CareerController::class,
        'site-settings' => SiteSettingController::class,
        'pages' => PageController::class,
    ];

    foreach ($resources as $slug => $controller) {
        Route::resource($slug, $controller);

        Route::post("$slug/bulk-destroy", [$controller, 'bulkDestroy'])->name("$slug.bulk-destroy");
        Route::post("$slug/toggle-status/{id}", [$controller, 'toggleStatus'])->name("$slug.toggle-status");

        # Additional route for teams
        if ($slug === 'teams') {
            Route::post('teams/update-order', [TeamController::class, 'updateOrder'])->name('teams.update-order');

        }
        if ($slug === 'pages') {
            Route::post('pages/update-order', [PageController::class, 'updateOrder'])->name('pages.update-order');
        }
    }


    Route::prefix('hero-sections')->name('hero-sections.')->controller(HeroSectionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit'); // No ID parameter
        Route::put('/update', 'update')->name('update'); // No ID parameter\

    });


    Route::prefix('abouts')->name('abouts.')->controller(AboutController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
    });


    # Site Settings
    Route::prefix('site_setting')->name('site_setting.')->controller(SiteSettingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/delete', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
    });

});

# Update route for site settings outside of prefix group
Route::put('backend/settings/{id}', [SiteSettingController::class, 'update'])->name('admin.settings.update')->middleware('auth');

# Fallback 404
Route::fallback(function () {
    return response()->view('website.404', [], 404);
});
