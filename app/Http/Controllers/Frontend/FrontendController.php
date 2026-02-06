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
        return view('website.index', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages
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
        $services = Service::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        return view('website.service', [
            'siteSetting' => $this->siteSetting,
            'pages' => $this->pages,
            'services' => $services
        ]);
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

        return view('website.service-single', compact('service'));
    }

}
