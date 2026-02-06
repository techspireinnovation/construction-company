<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Page;

class FrontendController extends Controller
{
    protected $siteSetting;
    protected $pages;

    public function __construct()
    {
        // Get first settings row
        $this->siteSetting = SiteSetting::first();

        // Get active pages ordered
        $this->pages = Page::where('status', 1)
            ->orderBy('order_no')
            ->get();
    }

    public function indexHome()
    {
        // Fetch all active services
        $services = Service::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        return view('website.index', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages,
            'services' => $services,
        ]);
    }


    public function indexAbout()
    {
        return view('website.about', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }

    public function indexTeam()
    {
        return view('website.team', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }

    public function indexTestimonial()
    {
        return view('website.testimonial', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }

    public function indexBlog()
    {
        return view('website.blog', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }

    public function indexContact()
    {
        return view('website.contact', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }

    public function indexPortfolio()
    {
        return view('website.portfolio', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }

    public function indexCareer()
    {
        return view('website.career', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }

    public function indexService()
{
    // Fetch the Services Page (type = 3)
    $page = Page::where('type', 3)
        ->where('status', 1)
        ->with('seoDetail')
        ->first();

    // Prepare SEO meta using reusable method
    $seoMeta = $this->generateSeo(
        $page,                                   // model
        'Our Services',                           // default title
        'Explore our professional services',     // default description
        'services, IT solutions, business',      // default keywords
        asset('Website/images/background/image-1.jpg') // default image
    );

    // Fetch all active services
    $services = Service::where('status', 1)
        ->whereNull('deleted_at')
        ->latest()
        ->get();

    // Return view with page, services, and SEO
    return view('website.service', array_merge(
        compact('services', 'page'),
        $seoMeta
    ));
}


    public function indexGallery()
    {
        return view('website.gallery', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
        ]);
    }
    public function serviceSingle($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Use reusable SEO method
        $seoMeta = $this->generateSeo($service);

        return view('website.service-single', array_merge(
            compact('service'),
            $seoMeta
        ));
    }


    /**
     * Generate SEO meta data for any model
     *
     * @param  mixed $model
     * @param  string $defaultTitle
     * @param  string $defaultDescription
     * @param  string $defaultKeywords
     * @param  string $defaultImage
     * @return array
     */
    protected function generateSeo($model, $defaultTitle = '', $defaultDescription = '', $defaultKeywords = '', $defaultImage = '')
    {
        $seo = $model->seoDetail ?? null;

        // Title fallback
        $title = $seo->seo_title ?? $model->title ?? $defaultTitle ?? 'Website';

        // Description fallback
        $description = $seo->seo_description ?? ($model->short_description ?? $defaultDescription ?? 'IT Solutions & Business Services Multipurpose Responsive Website Template');

        // Keywords fallback
        $keywords = $seo->seo_keywords ? implode(',', $seo->seo_keywords) : ($defaultKeywords ?? 'IT solutions, Business Services, TechnoxIt, Bootstrap Template');

        // Image fallback
        if ($seo && $seo->seo_image) {
            $image = asset('storage/' . $seo->seo_image);
        } elseif (isset($model->banner_image) && $model->banner_image) {
            $image = asset('storage/' . $model->banner_image);
        } else {
            $image = $defaultImage ?: asset('Website/images/background/image-1.jpg');
        }

        return [
            'meta_title' => $title,
            'meta_description' => $description,
            'meta_keywords' => $keywords,
            'meta_image' => $image,
        ];
    }


}
