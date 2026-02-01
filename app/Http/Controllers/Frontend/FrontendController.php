<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexHome()
    {


        return view('website.index');
    }

    public function indexAbout()
    {


        return view('website.about');
    }
    public function indexTeam()
    {


        return view('website.team');
    }
    public function indexTestimonial()
    {


        return view('website.testimonial');
    }
    public function indexBlog()
    {


        return view('website.blog');
    }
    public function indexContact()
    {


        return view('website.contact');
    }

    public function indexPortfolio()
    {




        return view('website.portfolio');
    }
    public function indexCareer()
    {


        return view('website.career');
    }
    public function indexService()
    {


        return view('website.service');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
