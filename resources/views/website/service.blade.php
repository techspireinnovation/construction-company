@extends('layouts.frontend.master')
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>Our Services</title>
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
<!-- Content -->
<div class="page-content">

    {{-- Use reusable page banner component --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'Services']
        ];
    @endphp

    <x-page-banner
        title="Our Services"
        :banner="asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
/>

    <!-- content area -->
    <div class="section-full content-inner-3 service-page">
        <div class="container">
            <div class="row">
                @if(isset($services) && $services->count())
                    @foreach($services as $service)
                        <div class="col-lg-4 col-sm-6">
                            <div class="sr-pg-bx">
                                <figure class="sr-img-bx">
                                    <a href="{{ route('web.service.single', $service->slug) }}">
                                        <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('Website/images/service/service-1.jpg') }}"
                                             alt="{{ $service->title ?? 'Service Image' }}">
                                    </a>
                                </figure>
                                <div class="cont-bx">
                                    <a href="{{ route('web.service.single', $service->slug) }}">
                                        <h4>{{ $service->title ?? 'Service Title' }}</h4>
                                    </a>
                                    <p class="m-0">{{ $service->short_description ?? 'Lorem Ipsum dummy text.' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="col-12">
                    <p>No Services available.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- content area end -->

</div>
<!-- content-end -->
@endsection
