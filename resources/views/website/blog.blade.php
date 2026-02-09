@extends('layouts.frontend.master')

@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>Blogs</title>
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
    .side-bar .widget form .form-control {

    color: #000000;
    }
</style>
@endsection
@section('content')
<div class="page-content">

    {{-- Page Banner --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'Our Blogs']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'Our Blogs'"
        :banner="$page->banner_image ? asset('storage/' . $page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />

    <!-- content area -->
    <div class="section-full content-inner-3 blog-page blog-sc">
        <div class="container">
            <div class="row">

                <div class="col-xl-8 col-lg-8">
                    @if(isset($searchQuery) && $searchQuery != '')
                    <h4>Search results for: "{{ $searchQuery }}"</h4>
                @endif
                    <div class="row">


                        @foreach($blogs as $blog)
                        <div class="col-lg-6 col-sm-6">
                            <div class="blog-post blog-grid">
                                <div class="dez-post-media dez-img-effect">
                                    <a href="{{ route('web.blog.single', $blog->slug) }}">
                                        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('Website/images/blog/image-1.jpg') }}" alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="dez-info">
                                    <div class="dez-post-meta">
                                        By {{ $blog->written_by ?? 'Admin' }} | {{ $blog->created_at->format('F d, Y') }}
                                    </div>
                                    <div class="dez-post-title">
                                        <h5 class="post-title">
                                            <a href="{{ route('web.blog.single', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h5>
                                    </div>
                                    <div class="dez-post-text">
                                        <p>{{ $blog->short_description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            {{ $blogs->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>

                <!-- Side bar start -->
                <div class="col-xl-4 col-lg-4">
                    <aside class="side-bar">
                        {{-- Search Widget --}}
                        <div class="widget">
                            <div class="search-bx">
                                <form role="search" method="get" action="{{ route('web.blog.search') }}">
                                    <div class="input-group">
                                        <input name="query" type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <button type="submit" class="site-button"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Categories Widget --}}
                        <div class="widget widget_categories">
                            <h4 class="widget-title">Categories List</h4>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('web.blog.category', $category->slug) }}">{{ $category->title }}</a> ({{ $category->blogs_count ?? 0 }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Recent Posts Widget --}}
                        <div class="widget recent-posts-entry">
                            <h4 class="widget-title">Recent Posts</h4>
                            <div class="widget-post-bx">
                                @foreach($recentBlogs as $recent)
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media">
                                        <a href="{{ route('web.blog.single', $recent->slug) }}">
                                            <img src="{{ $recent->image ? asset('storage/' . $recent->image) : asset('Website/images/blog/post-1.jpg') }}" alt="{{ $recent->title }}">
                                        </a>
                                    </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h4 class="post-title">
                                                <a href="{{ route('web.blog.single', $recent->slug) }}">{{ $recent->title }}</a>
                                            </h4>
                                        </div>
                                        <div class="dez-post-meta">
                                            <div class="post-date">{{ $recent->created_at->format('F d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
                <!-- Side bar END -->
            </div>
        </div>
    </div>
    <!-- content area end -->
</div>
<!-- content-end -->
@endsection
