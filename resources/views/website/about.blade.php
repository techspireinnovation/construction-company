@extends('layouts.frontend.master')

@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>About Us</title>
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
    .box{
        padding: 50px 20px 50px 20px;
        box-shadow: 0 0 10px rgba(0,0,0,.1);
    }
    </style>
    @endsection

@section('content')
<div class="page-content">

    {{-- Page Banner --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'About US']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'About US'"
        :banner="$page->banner_image ? asset('storage/' . $page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />

		<!-- content area -->
        <div class="section-full content-inner about-bx">
            <div class="container">
                <div class="row">

                    @php
                        $missions = json_decode($about->mission ?? '', true) ?? [];
                        $visions  = json_decode($about->vision ?? '', true) ?? [];
                    @endphp

                    {{-- LEFT CONTENT --}}
                    <div class="col-lg-6 m-b30">

                        {{-- Title --}}
                        <h5>
                            {{ $about->title ?? 'We build dream for better life with great idea.' }}
                        </h5>

                        {{-- Description --}}
                        <p>
                            {{ $about->description
                                ?? "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                            }}
                        </p>

                        {{-- Button --}}
                        <div class="d-flex">
                            <div class="m-r50 align-self-center"> <a href="{{ route('web.services') }}" class="site-button">Know More</a> </div> </div>
                    </div>


                    {{-- RIGHT CONTENT --}}
                    <div class="col-lg-6">
                        <div class="row">

                            {{-- ================= MISSION ================= --}}
                            <div class="col-md-6 col-sm-6 col-12">

                                <div class="m-b20 media-box">
                                    <img
                                        src="
                                        @if(!empty($missions) && !empty($missions[0]['image']))
                                            {{ asset('storage/'.$missions[0]['image']) }}
                                        @else
                                            {{ asset('Website/images/item/image-7.jpg') }}
                                        @endif
                                        "
                                        alt="Mission"
                                    >
                                </div>

                                <h5>Our Mission</h5>

                                <p>
                                    @if(!empty($missions) && !empty($missions[0]['content']))
                                        {{ $missions[0]['content'] }}
                                    @else
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.
                                    @endif
                                </p>

                            </div>


                            {{-- ================= VISION ================= --}}
                            <div class="col-md-6 col-sm-6 col-12">

                                <div class="m-b20 media-box">
                                    <img
                                        src="
                                        @if(!empty($visions) && !empty($visions[0]['image']))
                                            {{ asset('storage/'.$visions[0]['image']) }}
                                        @else
                                            {{ asset('Website/images/item/image-8.jpg') }}
                                        @endif
                                        "
                                        alt="Vision"
                                    >
                                </div>

                                <h5>Our Vision</h5>

                                <p>
                                    @if(!empty($visions) && !empty($visions[0]['content']))
                                        {{ $visions[0]['content'] }}
                                    @else
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.
                                    @endif
                                </p>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>



		<!-- Approach -->
        <div class="section-full content-inner approach">
            <div class="container">

                {{-- Section Head --}}
                <div class="row">
                    <div class="col-12">
                        <div class="section-head text-center">
                            <h2>Why Choose Us</h2>
                            <div class="divider-sc"></div>
                        </div>
                    </div>
                </div>

                <div class="row text-center">

                    @forelse($whyChooseUs as $key => $item)

                        <div class="col-md-4 col-sm-12 col-12 m-b30">
                            <div class="box {{ $key == 1 ? 'active' : '' }}">

                                {{-- ICON --}}
                                <div class="icon_box">
                                    <span>

                                        {{-- If image icon --}}
                                        @if(!empty($item->icon) && file_exists(public_path('storage/'.$item->icon)))

                                            <img
                                                src="{{ asset('storage/'.$item->icon) }}"
                                                alt="{{ $item->title }}"
                                                style="width:60px; height:60px; object-fit:contain;"
                                            >

                                        {{-- If FA class icon --}}
                                        @elseif(!empty($item->icon))

                                            <i class="{{ $item->icon }}"></i>

                                        {{-- Fallback icon --}}
                                        @else

                                            <img
                                                src="{{ asset('Website/images/icon/default-icon.png') }}"
                                                alt="Default Icon"
                                                style="width:60px; height:60px; object-fit:contain;"
                                            >

                                        @endif

                                    </span>
                                </div>

                                {{-- TITLE --}}
                                <h4>
                                    {{ $item->title ?? 'Our Service Excellence' }}
                                </h4>

                                {{-- CONTENT --}}
                                <p>
                                    {{ $item->content
                                        ?? "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s."
                                    }}
                                </p>

                            </div>
                        </div>

                    @empty

                        {{-- STATIC FALLBACK --}}
                        @php
                            $fallback = [
                                [
                                    'icon' => 'fa fa-pencil',
                                    'title' => 'ARCHITECTURAL DESIGN',
                                    'content' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s."
                                ],
                                [
                                    'icon' => 'fa fa-refresh',
                                    'title' => 'RECONSTRUCTION SERVICES',
                                    'content' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s."
                                ],
                                [
                                    'icon' => 'fa fa-bolt',
                                    'title' => 'ELECTRICAL SYSTEMS',
                                    'content' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s."
                                ],
                            ];
                        @endphp

                        @foreach($fallback as $index => $item)
                            <div class="col-md-4 col-sm-12 col-12 m-b30">
                                <div class="approach-bx {{ $index == 1 ? 'active' : '' }}">

                                    <div class="icon_box">
                                        <span>
                                            <i class="{{ $item['icon'] }}"></i>
                                        </span>
                                    </div>

                                    <h4>{{ $item['title'] }}</h4>
                                    <p>{{ $item['content'] }}</p>

                                </div>
                            </div>
                        @endforeach

                    @endforelse

                </div>
            </div>
        </div>


		<!-- Approach end -->
		<!-- team -->
		<div class="team section-full content-inner overlay-black-dark"
     style="background-image:url({{asset('Website/images/background/image-3.jpg')}});">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="section-head text-white">
                    <h2>Meet Our team</h2>
                    <div class="divider-sc"></div>
                </div>
            </div>
        </div>

        <div class="row">

            @forelse($teams as $team)
                <div class="col-lg-3 col-sm-6 col-12 m-b30">
                    <div class="team-bx">

                        <figure class="team-img-bx">

                            <a href="#">
                                @php
                                $imagePath = $team->image;

                                if ($imagePath && !Str::startsWith($imagePath, ['http','storage','uploads'])) {
                                    $imagePath = 'storage/'.$imagePath;
                                }
                            @endphp

                            <img src="{{ asset($imagePath) }}" alt="{{ $team->name }}">

                            </a>

                            <div class="team-overlay-bx">
                                <div class="team-in-bx">
                                    <ul class="social-link">

                                        @php
                                            $facebook = $team->facebook ?? $team->facebook_link ?? null;
                                            $twitter  = $team->twitter ?? $team->twitter_link ?? null;
                                            $linkedin = $team->linkedin ?? $team->linkedin_link ?? null;
                                            $instagram = $team->instagram ?? $team->instagram_link ?? null;
                                        @endphp

                                        @if($facebook)
                                            <li>
                                                <a href="{{ $facebook }}" target="_blank">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if($twitter)
                                            <li>
                                                <a href="{{ $twitter }}" target="_blank">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if($linkedin)
                                            <li>
                                                <a href="{{ $linkedin }}" target="_blank">
                                                    <i class="fa fa-linkedin"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if($instagram)
                                            <li>
                                                <a href="{{ $instagram }}" target="_blank">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                        @endif

                                    </ul>

                                </div>
                            </div>

                        </figure>

                        <div class="user-bx text-center">
                            <h4>{{ $team->name }}</h4>
                            <a href="#">
                                <p class="position">{{ $team->designation }}</p>
                            </a>
                        </div>

                    </div>
                </div>

            @empty

                {{-- If no team found --}}
                <div class="col-12 text-center text-white">
                    <p>No team members available.</p>
                </div>

            @endforelse

        </div>
    </div>
</div>

		<!-- team end -->
		<!-- Press -->
		<div class="team section-full content-inner-2 Press">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="section-head text-center">
                            <h2>Latest Blogs</h2>
                            <div class="divider-sc"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="img-carousel-dots-nav owl-btn-3 owl-carousel owl-theme owl-none">

                            @foreach($blogs as $blog)
                            <div class="item">

                                {{-- Image --}}
                                <div class="Press-bx">
                                    <img src="{{ $blog->image
                                        ? asset('storage/'.$blog->image)
                                        : asset('Website/images/item/image-12.jpg') }}"
                                        alt="{{ $blog->title }}">
                                </div>

                                {{-- Content --}}
                                <div class="Press-cont">

                                    <h4>
                                        <a href="{{ route('web.blog.single', $blog->slug) }}">
                                            {{ $blog->title }}
                                        </a>
                                    </h4>

                                    <p class="date">
                                        {{ $blog->created_at->format('d F, Y') }}
                                    </p>

                                    <p>
                                        {{ Str::limit($blog->short_description, 120) }}
                                    </p>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>

		<!-- Press end -->
		<!-- subscribe -->
		<div class="section-full content-inner-2 subscribe" style="background-image:url({{asset('Website/images/background/image-2.jpg')}});">
			<div class="container text-center text-white">
				<div class="row">
					<div class="col-md-8 m-auto">
						<div class="section-head">
							<h2>Subscribe For Newsletter</h2>
                            <p>Stay updated with our latest news, exciting projects, exclusive offers, and expert insights directly in your inbox. Enter your email below to subscribe and never miss an update from us.</p>
						</div>
                        @if(session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
						<form class="dzSubscribe" action="{{ route('subscribe.store') }}"
                        method="post">

                      @csrf
                      <div class="dzSubscribeMsg"></div>

							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-envelope"></i></span>
								</div>
								<input name="email" required="required" class="form-control" placeholder="Your Email Address" type="email">
								<div class="input-group-append">
									<button class="site-button" name="submit" value="Submit" type="submit">Subscribe us</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- subscribe end -->
		<!-- content area end -->
	</div>
	<!-- content-end -->
@endsection