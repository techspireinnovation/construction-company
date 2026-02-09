@extends('layouts.frontend.master')

@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>Testimonials</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:image" content="{{ $meta_image }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $meta_title }}">
    <meta property="twitter:description" content="{{ $meta_description }}">
    <meta property="twitter:image" content="{{ $meta_image }}">
@endsection

@section('content')
<div class="page-content">

    {{-- Page Banner --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'Testimonials']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'Testimonials'"
        :banner="$page->banner_image ? asset('storage/' . $page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />

    <!-- Testimonials Section -->
    <div class="section-full content-inner-3 testimonial-page text-center">
        <div class="container">
            <div class="row">
                @forelse($testimonials as $testimonial)
                    <div class="col-lg-3 col-sm-6">
                        <div class="testimonial-des">
                            <figure>
                                <a href="#"><img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('Website/images/team/1.png') }}" alt="{{ $testimonial->name }}"></a>
                            </figure>
                            <div class="testimonial-cont">
                                <p class="m-0">{{ $testimonial->message }}</p>
                            </div>
                            <h5 class="m-b5">{{ $testimonial->name }}</h5>
                            <p class="city m-0">{{ $testimonial->designation }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No testimonials available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Testimonials Section End -->

</div>
@endsection
