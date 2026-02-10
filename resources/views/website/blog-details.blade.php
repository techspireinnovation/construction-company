@extends('layouts.frontend.master')

@section('meta_content')
<title>{{ $meta_title }}</title>
    <!-- HTML Meta Tags -->
    <meta name="description" content="{{ is_array($meta_description) ? implode(' ', $meta_description) : $meta_description }}">
    <meta name="keywords" content="{{ is_array($meta_keywords) ? implode(',', $meta_keywords) : $meta_keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ is_array($meta_description) ? implode(' ', $meta_description) : $meta_description }}">
    <meta property="og:image" content="{{ $meta_image }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $meta_title }}">
    <meta property="twitter:description" content="{{ is_array($meta_description) ? implode(' ', $meta_description) : $meta_description }}">
    <meta property="twitter:image" content="{{ $meta_image }}">
@endsection
@section('style')
<style>
    .widget_categories ul li {
    padding: 10px 20px 30px 0px;
    color: #767676;
}

    .blog-description p {
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
            ['label' => 'Blogs', 'url' => route('web.blog')],
            ['label' => $blog->title]
        ];
    @endphp

    <!-- Page Banner Component -->
    <x-page-banner
        :title="$blog->title"
        :banner="isset($blog) && $blog->banner_image ? asset('storage/' . $blog->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />

    <!-- Blog Content Section -->
    <div class="section-full content-inner-3 blog-single blog-detail-pg">
        <div class="container">
            <div class="row">

                <!-- Main Blog Content -->
                <div class="col-lg-8 col-xl-8">
                    <div class="blog-post blog-lg blog-style-1">
                        <div class="dez-post-media">
                            <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('Website/images/blog/image-7.jpg') }}" alt="{{ $blog->title }}">
                        </div>

                        <div class="dez-post-title">
                            <h5>{{ $blog->category->title ?? 'Uncategorized' }}</h5>
                            <h4 class="post-title">{{ $blog->title }}</h4>
                        </div>

                        <div class="dez-info">
                            <div class="dez-post-meta">
                                <ul class="d-flex align-items-center">
                                    <li class="post-author">by <a href="#">{{ $blog->written_by ?? 'Admin' }}</a></li>
                                    <li class="post-date">{{ $blog->created_at->format('F d, Y') }}</li>
                                </ul>
                            </div>

                            <div class="blog-description">
                                {!! $blog->description !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-xl-4">
                    <aside class="side-bar">

                        <!-- Categories Widget -->
                        <div class="widget widget_categories">
                            <h4 class="widget-title">Categories List</h4>
                            <ul>
                                @foreach(\App\Models\BlogCategory::where('status',1)->get() as $category)
                                    <li class="{{ isset($currentCategory) && $currentCategory->id == $category->id ? 'active' : '' }}">
                                        <a href="{{ route('web.blog.category', $category->slug) }}">{{ $category->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Recent Posts Widget -->
                        <div class="widget recent-posts-entry">
                            <h4 class="widget-title">Recent Posts</h4>
                            <div class="widget-post-bx">
                                @foreach(\App\Models\Blog::where('status',1)->latest()->take(3)->get() as $recent)
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

            </div>
        </div>
    </div>

</div>
@endsection
