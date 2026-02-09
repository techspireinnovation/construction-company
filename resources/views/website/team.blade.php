@extends('layouts.frontend.master')

{{-- ================= META ================= --}}
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>Teams</title>
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


{{-- ================= CONTENT ================= --}}
@section('content')

<div class="page-content">

    {{-- ===== Page Banner ===== --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => $page->title ?? 'Team']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'Meet Our Team'"
        :banner="$page->banner_image ? asset('storage/' . $page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />


    {{-- ===== Team Section ===== --}}
    <div class="team team-1 content-inner-3 section-full">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-head">
                        <h2>{{ $page->title ?? 'Creative Team' }}</h2>
                        <div class="divider-sc"></div>
                    </div>
                </div>
            </div>

            <div class="row">

                @forelse($teams as $team)

                    <div class="col-lg-3 col-sm-6 col-12 m-b50">
                        <div class="team-bx">

                            {{-- Image --}}
                            <figure class="team-img-bx">
                                <a href="#">
                                    <img src="{{ $team->image ? asset('storage/'.$team->image) : asset('Website/images/team/image-1.jpg') }}" alt="{{ $team->name }}">
                                </a>

                                {{-- Overlay --}}
                                <div class="team-overlay-bx">
                                    <div class="team-in-bx">
                                        <ul class="social-link">

                                            @if($team->facebook_link)
                                                <li>
                                                    <a href="{{ $team->facebook_link }}" target="_blank">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            @if($team->instagram_link)
                                                <li>
                                                    <a href="{{ $team->instagram_link }}" target="_blank">
                                                        <i class="fa fa-instagram"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            @if($team->linkedin_link)
                                                <li>
                                                    <a href="{{ $team->linkedin_link }}" target="_blank">
                                                        <i class="fa fa-linkedin"></i>
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </figure>

                            {{-- Info --}}
                            <div class="user-bx text-center">
                                <h4>{{ $team->name }}</h4>
                                <p class="position">{{ $team->designation }}</p>
                            </div>

                        </div>
                    </div>

                @empty

                    <div class="col-12 text-center">
                        <p>No team members found.</p>
                    </div>

                @endforelse

            </div>

        </div>
    </div>

</div>

@endsection
