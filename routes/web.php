<?php

use App\Http\Controllers\Backend\AppreciationController;
use App\Http\Controllers\Backend\AwardController;
use App\Http\Controllers\Backend\BenefitController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ExpertiseController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\OperationController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SolutionController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PageTypeController;
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
Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blog.delete')->middleware('auth');
Route::get('/blogs/archive/{year}', [BlogController::class, 'archive'])->name('blog.archive')->middleware('auth');

Route::get('blog-categories', [BlogCategoryController::class, 'index'])->name('blog_category.index')->middleware('auth');
Route::get('blog-categories/create', [BlogCategoryController::class, 'create'])->name('blog_category.create')->middleware('auth');
Route::get('blog-categories/edit/{id}', [BlogCategoryController::class, 'edit'])->name('blog_category.edit')->middleware('auth');
Route::post('blog-categories', [BlogCategoryController::class, 'store'])->name('blog_category.store')->middleware('auth');
Route::put('blog-categories/{id}', [BlogCategoryController::class, 'update'])->name('blog_category.update')->middleware('auth');
Route::delete('blog-categories/{id}', [BlogCategoryController::class, 'destroy'])->name('blog_category.destroy')->middleware('auth');
Route::patch('blog_category/{id}/toggle-status', [BlogCategoryController::class, 'toggleStatus'])->name('blog_category.toggle_status')->middleware('auth');
Route::post('blog_category/bulk-destroy', [BlogCategoryController::class, 'bulkDestroy'])->name('blog_category.bulk_destroy')->middleware('auth');



Route::middleware(['auth'])->group(function () {
    Route::get('blog/category/{category_id}', [BlogController::class, 'category'])->name('blog.category'); // Filter by category
    Route::get('blog/tag/{tag}', [BlogController::class, 'tag'])->name('blog.tag'); // Filter by tag
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

Route::prefix('admin/sliders')->name('admin.sliders.')->controller(SliderController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/store', 'store')->name('store');
    Route::get('/store', function () {
        return redirect()->route('admin.sliders.index')->with('error', 'Invalid request method.');
    })->name('store.get');
    Route::post('/delete', 'destroy')->name('destroy');
    Route::get('/search', 'search')->name('search');
});
Route::put('backend/sliders/{id}', [SliderController::class, 'update'])->name('admin.sliders.update')->middleware('auth');
Route::patch('backend/sliders/{id}/toggle-status', [SliderController::class, 'toggleStatus'])->name('admin.sliders.toggle_status')->middleware('auth');
Route::post('backend/sliders/bulk-destroy', [SliderController::class, 'bulkDestroy'])->name('admin.sliders.bulk_destroy')->middleware('auth');

Route::prefix('admin/site_setting')->name('admin.site_setting.')->controller(SiteSettingController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/delete', 'destroy')->name('destroy');
    Route::get('/search', 'search')->name('search');
});
Route::put('backend/settings/{id}', [SiteSettingController::class, 'update'])->name('admin.settings.update')->middleware('auth');

Route::prefix('admin/partners')->name('admin.partners.')->controller(PartnerController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::post('/store', 'store')->name('store');
    Route::get('/store', function () {
        return redirect()->route('admin.partners.index')->with('error', 'Invalid request method.');
    })->name('store.get');
    Route::post('/destroy/{id}', 'destroy')->name('destroy'); // New route for single deletion
    Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy'); // Updated for bulk deletion
    Route::get('/search', 'search')->name('search');
    Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
});



Route::prefix('admin/gallery')->name('admin.gallery.')->controller(GalleryController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::post('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy');
    Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
    Route::get('/search', 'search')->name('search');
});



Route::prefix('admin')->name('admin.')->group(function () {

    // Standard CRUD routes for Service
    Route::resource('services', ServiceController::class);

    // Custom routes
    Route::post('services/bulk-destroy', [ServiceController::class, 'bulkDestroy'])->name('services.bulk-destroy');
    Route::post('services/toggle-status/{id}', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

});

Route::prefix('admin/expertises')->name('admin.expertises.')->controller(ExpertiseController::class)->middleware('auth')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::post('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy');
    Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
    Route::get('/search', 'search')->name('search');
});



Route::prefix('admin/operations')->name('admin.operations.')->controller(OperationController::class)->middleware('auth')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::post('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy');
    Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
    Route::get('/search', 'search')->name('search');
});


Route::prefix('admin/solutions')->name('admin.solutions.')->controller(SolutionController::class)->middleware('auth')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::post('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy');
    Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
    Route::get('/search', 'search')->name('search');
});


Route::prefix('admin/benefits')->name('admin.benefits.')->controller(BenefitController::class)->middleware('auth')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::post('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy');
    Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
    Route::get('/search', 'search')->name('search');
});


Route::prefix('admin/awards')->name('admin.awards.')->controller(AwardController::class)->middleware('auth')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::patch('/update/{id}', 'update')->name('update');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy');
    Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
    Route::get('/search', 'search')->name('search');
});


// Route::prefix('admin/awards')->name('admin.awards.')->controller(AwardController::class)->middleware('auth')->group(function () {

//     Route::get('/', 'index')->name('index');
//     Route::get('/create', 'create')->name('create');
//     Route::post('/store', 'store')->name('store');
//     Route::get('/edit/{id}', 'edit')->name('edit');
//     Route::patch('/update/{id}', 'update')->name('update');
//     Route::delete('/destroy/{id}', 'destroy')->name('destroy');
//     Route::post('/bulk-destroy', 'bulkDestroy')->name('bulk-destroy');
//     Route::post('/toggle-status/{id}', 'toggleStatus')->name('toggle-status');
//     Route::get('/search', 'search')->name('search');
// });



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('page_types', PageTypeController::class)->except(['show']);
    Route::get('page_types/search', [PageTypeController::class, 'search'])->name('page_types.search');
});




Route::prefix('admin')->group(function () {
    Route::get('/why-choose-us', [WhyChooseUsController::class, 'index'])->name('admin.why_choose_us.index');
    Route::get('/why-choose-us/search', [WhyChooseUsController::class, 'search'])->name('admin.why_choose_us.search');
    Route::get('/why-choose-us/create', [WhyChooseUsController::class, 'create'])->name('admin.why_choose_us.create');
    Route::post('/why-choose-us', [WhyChooseUsController::class, 'store'])->name('admin.why_choose_us.store');
    Route::get('/why-choose-us/{id}/edit', [WhyChooseUsController::class, 'edit'])->name('admin.why_choose_us.edit');
    Route::put('/why-choose-us/{id}', [WhyChooseUsController::class, 'update'])->name('admin.why_choose_us.update');
    Route::delete('/why-choose-us/{id}', [WhyChooseUsController::class, 'destroy'])->name('admin.why_choose_us.destroy');
});



Route::prefix('admin')->name('admin.')->group(function () {

    // Standard CRUD routes for Testimonial
    Route::resource('testimonials', TestimonialController::class);

    // Custom routes
    Route::post('testimonials/bulk-destroy', [TestimonialController::class, 'bulkDestroy'])->name('testimonials.bulk-destroy');
    Route::post('testimonials/toggle-status/{id}', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');

});


Route::prefix('admin')->group(function () {
    Route::get('/appreciations', [AppreciationController::class, 'index'])->name('admin.appreciations.index');
    Route::get('/appreciations/create', [AppreciationController::class, 'create'])->name('admin.appreciations.create');
    Route::post('/appreciations', [AppreciationController::class, 'store'])->name('admin.appreciations.store');
    Route::get('/appreciations/{id}/edit', [AppreciationController::class, 'edit'])->name('admin.appreciations.edit');
    Route::put('/appreciations/{id}', [AppreciationController::class, 'update'])->name('admin.appreciations.update');
    Route::delete('/appreciations/{id}', [AppreciationController::class, 'destroy'])->name('admin.appreciations.destroy');
    Route::patch('/appreciations/{id}/toggle-status', [AppreciationController::class, 'toggle_status'])->name('admin.appreciations.toggle_status');
    Route::post('/appreciations/bulk-destroy', [AppreciationController::class, 'bulk_destroy'])->name('admin.appreciations.bulk_destroy');
});




Route::prefix('admin')->group(function () {
    Route::get('/careers', [CareerController::class, 'index'])->name('admin.careers.index');
    Route::get('/careers/create', [CareerController::class, 'create'])->name('admin.careers.create');
    Route::post('/careers', [CareerController::class, 'store'])->name('admin.careers.store');
    Route::get('/careers/{id}/edit', [CareerController::class, 'edit'])->name('admin.careers.edit');
    Route::put('/careers/{id}', [CareerController::class, 'update'])->name('admin.careers.update');
    Route::delete('/careers/{id}', [CareerController::class, 'destroy'])->name('admin.careers.destroy');
    Route::patch('/careers/{id}/toggle-status', [CareerController::class, 'toggle_status'])->name('admin.careers.toggle_status');
    Route::post('/careers/bulk-destroy', [CareerController::class, 'bulk_destroy'])->name('admin.careers.bulk_destroy');
});

Route::fallback(function () {
    return response()->view('website.404', [], 404);
});