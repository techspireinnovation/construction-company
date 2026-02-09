@extends('layouts.frontend.master')

@section('meta_content')
<title>Career Opportunities</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $meta_title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:image" content="{{ $meta_image }}">

<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $meta_title }}">
<meta property="twitter:description" content="{{ $meta_description }}">
<meta property="twitter:image" content="{{ $meta_image }}">
@endsection
@section('style')
<style>
    h5 a, h6 a {
    color: #ffffff;
}
</style>
@endsection

@section('content')
<div class="page-content">

    {{-- Banner --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'Careers']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'Careers'"
        :banner="$page && $page->banner_image ? asset('storage/'.$page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />


    {{-- Career List --}}
    <div class="section-full content-inner-2 service">
        <div class="container">
            <div class="row">

                @forelse($careers as $career)
                    <div class="col-lg-4 col-md-6">
                        <div class="sr-box">
                            <figure class="sr-img-bx">

                                {{-- Banner Image --}}
                                <a href="{{ route('web.career.single', $career->slug) }}">
                                    <img
                                        src="{{ $career->banner_image ? asset('storage/'.$career->banner_image) : asset('Website/images/item/image-1.jpg') }}"
                                        alt="{{ $career->job_title }}"
                                        style="height:260px; width:100%; object-fit:cover;"
                                    >
                                </a>

                                {{-- Overlay --}}
                                <div class="sr-overlay-bx">
                                    <div class="sr-in-bx">

                                        {{-- ICON --}}
                                        <div class="sr-icon-bx">
                                            <span>
                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                            </span>
                                        </div>

                                        {{-- TITLE + CONTENT --}}
                                        <div class="sr-title-box">
                                            <h5>
                                                <a href="{{ route('web.career.single', $career->slug) }}">
                                                    {{ $career->job_title }}
                                                </a>
                                            </h5>

                                            <div class="cont">

                                                {{-- Short Summary --}}
                                                <p>
                                                    {{ \Illuminate\Support\Str::limit($career->short_summery, 100) }}
                                                </p>

                                                {{-- Extra Info --}}
                                                <ul class="list-unstyled m-t10">

                                                    <li>
                                                        <i class="fa fa-clock-o m-r5"></i>
                                                        <strong>Type:</strong>
                                                        {{ \App\Helpers\CareerHelper::employmentType($career->employment_type) }}
                                                    </li>

                                                    <li>
                                                        <i class="fa fa-calendar m-r5"></i>
                                                        <strong>Deadline:</strong>
                                                        {{ $career->application_deadline?->format('M d, Y') ?? 'N/A' }}
                                                    </li>

                                                </ul>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </figure>
                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center">
                        <h4>No Career Openings Available</h4>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

</div>
@endsection
