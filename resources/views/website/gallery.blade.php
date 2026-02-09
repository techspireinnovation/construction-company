@extends('layouts.frontend.master')

@section('meta_content')
<title>Gallery</title>
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

@section('style')
<style>
    .mfp-title {
        display: none !important;
    }
</style>
@endsection

@section('content')
<div class="page-content">

    {{-- Page Banner --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'Gallery']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'Gallery'"
        :banner="$page->banner_image ? asset('storage/' . $page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />

    <!-- content area -->
    <div class="section-full content-inner-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="clearfix">
                        <div id="masonry" class="row dez-gallery-listing gallery-grid-4 gallery mfp-gallery port-style1">

                            @forelse($galleries as $gallery)
                                @foreach($gallery->images ?? [] as $image)
                                    <div class="card-container col-lg-4 col-sm-6">
                                        <div class="Project-bx">
                                            <div class="Proj-img-bx">
                                                <img src="{{ asset('storage/'.$image) }}" alt="{{ $gallery->title ?? 'Gallery Image' }}"/>
                                                <div class="Proj-overlay-eff">
                                                    <div class="proj-part">
                                                        <div class="Proj-cont">
                                                            <div class="first">
                                                                <ul class="list-inline">
                                                                    <li>
                                                                        <a href="{{ asset('storage/'.$image) }}" class="mfp-link">
                                                                            <i class="fa fa-search-plus"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @empty
                                {{-- Fallback Static Images --}}
                                @for($i=1; $i<=6; $i++)
                                    <div class="card-container col-lg-4 col-sm-6">
                                        <div class="Project-bx">
                                            <div class="Proj-img-bx">
                                                <img src="{{ asset('Website/images/project/image-'.$i.'.jpg') }}" alt="Gallery Image {{$i}}"/>
                                                <div class="Proj-overlay-eff">
                                                    <div class="proj-part">
                                                        <div class="Proj-cont">
                                                            <div class="first">
                                                                <ul class="list-inline">
                                                                    <li>
                                                                        <a href="{{ asset('Website/images/project/thumb-img-'.$i.'.jpg') }}" class="mfp-link">
                                                                            <i class="fa fa-search-plus"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

            {{-- Pagination --}}
          {{-- Pagination --}}
<div class="row">
    <div class="col-12 text-center">
        @if($galleries->hasPages())
            <ul class="pagination justify-content-center">
                {{-- Previous Page Link --}}
                @if ($galleries->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $galleries->previousPageUrl() }}">&laquo;</a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $pageNumber => $url)
                    <li class="page-item {{ $galleries->currentPage() == $pageNumber ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $pageNumber }}</a>
                    </li>
                @endforeach

                {{-- Next Page Link --}}
                @if ($galleries->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $galleries->nextPageUrl() }}">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
        @endif
    </div>
</div>

        </div>
    </div>
    <!-- content area end -->
</div>
<!-- content-end -->
@endsection
