@extends('layouts.frontend.master')

@section('meta_content')
<title>Projects</title>
    <!-- HTML Meta Tags -->
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
            ['label' => 'Our Projects']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'Our Projects'"
        :banner="$page->banner_image ? asset('storage/' . $page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />
        <!-- Breadcrumb row END -->
		<!-- content area -->
		<div class="section-full content-inner-2">
			<div class="container">
				<div class="row">
					<div class="col-12">
                        <div class="site-filters clearfix center m-b40">
                            <ul class="filters" data-toggle="buttons">
                                {{-- All filter --}}
                                <li data-filter="" class="btn active">
                                    <input type="radio">
                                    <a href="#" class="site-button-secondry button-sm radius-xl">All</a>
                                </li>

                                {{-- Dynamic Categories --}}
                                @foreach($categories as $category)
                                    <li data-filter="{{ Str::slug($category->title) }}" class="btn">
                                        <input type="radio">
                                        <a href="#" class="site-button-secondry button-sm radius-xl">{{ $category->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

						<div class="clearfix">
							<div id="masonry" class="row dez-gallery-listing gallery-grid-4 gallery mfp-gallery port-style1">
                                @forelse($portfolios as $portfolio)
                                    <div class="card-container {{ Str::slug($portfolio->category->title ?? 'uncategorized') }} col-lg-4 col-sm-6">
                                        <div class="Project-bx">
                                            <div class="Proj-img-bx">
                                                <img src="{{ asset('storage/'.$portfolio->banner_image) }}" alt="{{ $portfolio->title }}" />
                                                <div class="Proj-overlay-eff">
                                                    <div class="proj-part">
                                                        <div class="Proj-cont">
                                                            <div class="first">
                                                                <ul class="list-inline">

                                                                  <li>
                                                                  <a href="{{ route('web.portfolio.single',$portfolio->slug) }}">
                                                                  <i class="fa fa-link"></i>
                                                                  </a>
                                                                  </li>
                                                                    <li>
                                                                        <a href="{{ asset('storage/'.$portfolio->banner_image) }}" class="mfp-link" title="{{ $portfolio->title }}">
                                                                            <i class="fa fa-search-plus"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="title-bx text-center">
                                                <h5>{{ $portfolio->title }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <p>No portfolios found.</p>
                                    </div>
                                @endforelse
                            </div>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- content area end -->
	</div>
	<!-- content-end -->
    @endsection
