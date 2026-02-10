@extends('layouts.frontend.master')

@section('meta_content')
@php
    // Safe meta handling (string or array)
    $metaTitle = $meta_title ?? $portfolio->title ?? config('app.name');

    $metaDescription = is_array($meta_description ?? null)
        ? implode(' ', $meta_description)
        : ($meta_description ?? Str::limit(strip_tags($portfolio->description ?? ''),150));

    $metaKeywords = is_array($meta_keywords ?? null)
        ? implode(',', $meta_keywords)
        : ($meta_keywords ?? '');

    $metaImage = $meta_image
        ?? ($portfolio->banner_image
            ? asset('storage/'.$portfolio->banner_image)
            : asset('Website/images/background/image-1.jpg'));
@endphp
<title>{{ $portfolio->title ?? $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $metaImage }}">
@endsection

@section('style')
<style>
    .portfolio-description p {
    all: unset;
    display: block;    /* keep paragraph structure */
    color: #000000;
    line-height: 1.7;
    margin-bottom: 15px;
}

</style>
@endsection

@section('content')
<div class="page-content">

@php
    $breadcrumbs = [
        ['label' => 'Home', 'url' => route('web.home')],
        ['label' => 'Projects', 'url' => route('web.portfolio')],
        ['label' => $portfolio->title]
    ];

    // Decode gallery safely (handles array OR JSON string)
    $galleryImages = [];

    if (!empty($portfolio->images)) {
        $galleryImages = is_array($portfolio->images)
            ? $portfolio->images
            : json_decode($portfolio->images, true);
    }
@endphp


<x-page-banner
    :title="$portfolio->title"
    :banner="$portfolio->banner_image
        ? asset('storage/'.$portfolio->banner_image)
        : asset('Website/images/background/image-1.jpg')"
    :breadcrumbs="$breadcrumbs"
/>



<div class="section-full content-inner-3 single-service">
<div class="container">
<div class="row">

{{-- Sidebar --}}
<div class="col-lg-4 col-xl-3 m-b30">
<div class="side-link-service">
<ul class="service-list">

<li>
<a href="{{ route('web.portfolio') }}">
View All Projects
</a>
<span class="fa fa-briefcase"></span>
</li>

@php
$allProjects = App\Models\Portfolio::where('status',1)
    ->latest()
    ->get();
@endphp

@foreach($allProjects as $sidebarProject)
<li class="{{ $sidebarProject->id == $portfolio->id ? 'active' : '' }}">
<a href="{{ route('web.portfolio.single', $sidebarProject->slug) }}">
{{ $sidebarProject->title }}
</a>
</li>
@endforeach

</ul>
</div>
</div>



{{-- Content --}}
<div class="col-lg-8 col-xl-9">
<div class="right-side">

{{-- Image --}}
<div class="space">
<img src="{{ $portfolio->banner_image
        ? asset('storage/'.$portfolio->banner_image)
        : asset('Website/images/background/image-1.jpg') }}"
     alt="{{ $portfolio->title }}">
</div>



{{-- Title --}}
<div class="section-head">
<h2>{{ $portfolio->title }}</h2>
<div class="divider-sc"></div>
</div>





{{-- Description --}}
<div class="portfolio-description">
{!! $portfolio->description !!}
</div>



{{-- Project Info --}}
<div class="job-info-box p-4 bg-light">

<h4 class="m-b15">Project Information</h4>

<ul class="list-unstyled">

@if($portfolio->category)
<li>
<b>Category:</b>
{{ $portfolio->category->title }}
</li>
@endif

@if($portfolio->partner)
<li>
<b>Client / Partner:</b>
{{ $portfolio->partner->name }}
</li>
@endif

@if($portfolio->start_date)
<li>
<b>Start Date:</b>
{{ \Carbon\Carbon::parse($portfolio->start_date)->format('M d, Y') }}
</li>
@endif

@if($portfolio->end_date)
<li>
<b>End Date:</b>
{{ \Carbon\Carbon::parse($portfolio->end_date)->format('M d, Y') }}
</li>
@endif

</ul>
</div>



{{-- Gallery Images --}}
@if(!empty($galleryImages) && is_array($galleryImages))
<div class="m-t30">
<h4>Project Gallery</h4>

<div class="row">
@foreach($galleryImages as $img)
<div class="col-lg-4 col-md-6 m-b20">
<img src="{{ asset('storage/'.$img) }}"
     class="img-fluid rounded"
     alt="Gallery Image">
</div>
@endforeach
</div>
</div>
@endif



</div>
</div>

</div>
</div>
</div>

</div>
@endsection
