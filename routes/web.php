<?php
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SolutionController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\WhyChooseUsController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\CareerController;



Route::get('/', [FrontendController::class, 'indexHome'])->name('web.home');
Route::get('/contact', [FrontendController::class, 'indexContact'])->name('web.contact');
Route::get('/career', [FrontendController::class, 'indexCareer'])->name('web.career');
Route::get('/project', [FrontendController::class, 'indexPortfolio'])->name('web.portfolio');
Route::get('/about', [FrontendController::class, 'indexAbout'])->name('web.about');
Route::get('/team', [FrontendController::class, 'indexTeam'])->name('web.team');
Route::get('/blog', [FrontendController::class, 'indexBlog'])->name('web.blog');
Route::get('/testimonial', [FrontendController::class, 'indexTestimonial'])->name('web.testimonial');

Route::get('/services', [FrontendController::class, 'indexService'])->name('web.services');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::prefix('blogs')->name('blog.')->controller(BlogController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/store', 'store')->name('store');
    Route::get('/search', 'search')->name('search');
    Route::post('/draft', 'draft')->name('draft');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::post('blog-categories/bulk-destroy', [BlogCategoryController::class, 'bulkDestroy'])->name('blog-categories.bulk-destroy');

    Route::post(
        'blog-categories/toggle-status/{id}',
        [BlogCategoryController::class, 'toggleStatus']
    )->name('blog-categories.toggle-status');
});




Route::prefix('admin/pages')->name('admin.pages.')->controller(PageController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/store', 'store')->name('store');
    Route::get('/store', function () {
        return redirect()->route('admin.pages.index')->with('error', 'Invalid request method.');
    })->name('store.get');
    Route::post('/delete', 'delete')->name('delete');
    Route::get('/search', 'search')->name('search');
    Route::post('/update-page-type', 'updatePageType')->name('updatePageType');
});

Route::prefix('admin/site_setting')->name('admin.site_setting.')->controller(SiteSettingController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/delete', 'destroy')->name('destroy');
    Route::get('/search', 'search')->name('search');
});
Route::put('backend/settings/{id}', [SiteSettingController::class, 'update'])->name('admin.settings.update')->middleware('auth');
Route::prefix('admin')->name('admin.')->group(function () {

    // Standard CRUD routes for Partner
    Route::resource('partners', PartnerController::class);

    // Custom routes
    Route::post('partners/bulk-destroy', [PartnerController::class, 'bulkDestroy'])->name('partners.bulk-destroy');
    Route::post('partners/toggle-status/{id}', [PartnerController::class, 'toggleStatus'])->name('partners.toggle-status');

});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('galleries', GalleryController::class);

    Route::post('galleries/bulk-destroy', [GalleryController::class, 'bulkDestroy'])
        ->name('galleries.bulk-destroy');

    Route::post('galleries/toggle-status/{id}', [GalleryController::class, 'toggleStatus'])
        ->name('galleries.toggle-status');
});


Route::prefix('admin')->name('admin.')->group(function () {

    // Standard CRUD routes for Service
    Route::resource('services', ServiceController::class);

    // Custom routes
    Route::post('services/bulk-destroy', [ServiceController::class, 'bulkDestroy'])->name('services.bulk-destroy');
    Route::post('services/toggle-status/{id}', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

});




Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('why_choose_us', WhyChooseUsController::class);

    Route::post('why_choose_us/bulk-destroy', [WhyChooseUsController::class, 'bulkDestroy'])->name('why_choose_us.bulk-destroy');
    Route::post('why_choose_us/toggle-status/{id}', [WhyChooseUsController::class, 'toggleStatus'])->name('why_choose_us.toggle-status');

});



Route::prefix('admin')->name('admin.')->group(function () {

    // Standard CRUD routes for Testimonial
    Route::resource('testimonials', TestimonialController::class);

    // Custom routes
    Route::post('testimonials/bulk-destroy', [TestimonialController::class, 'bulkDestroy'])->name('testimonials.bulk-destroy');
    Route::post('testimonials/toggle-status/{id}', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');

});

Route::prefix('admin')->name('admin.')->group(function () {

    // Standard CRUD routes for Team
    Route::resource('teams', TeamController::class);

    // Custom routes
    Route::post('teams/bulk-destroy', [TeamController::class, 'bulkDestroy'])->name('teams.bulk-destroy');
    Route::post('teams/toggle-status/{id}', [TeamController::class, 'toggleStatus'])->name('teams.toggle-status');
    Route::post('teams/update-order', [TeamController::class, 'updateOrder'])
        ->name('teams.update-order');

});

Route::prefix('admin')->name('admin.')->group(function () {

    // Standard CRUD routes for FAQ
    Route::resource('faqs', FaqController::class);

    // Custom routes
    Route::post('faqs/bulk-destroy', [FaqController::class, 'bulkDestroy'])->name('faqs.bulk-destroy');
    Route::post('faqs/toggle-status/{id}', [FaqController::class, 'toggleStatus'])->name('faqs.toggle-status');

});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('careers', CareerController::class);

    Route::post('careers/bulk-destroy', [CareerController::class, 'bulkDestroy'])->name('careers.bulk-destroy');
    Route::post('careers/toggle-status/{id}', [CareerController::class, 'toggleStatus'])->name('careers.toggle-status');

});


Route::fallback(function () {
    return response()->view('website.404', [], 404);
});