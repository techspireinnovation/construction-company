@extends('layouts.frontend.master')

@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>Home</title>

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
    /* Minimize testimonial image size */
.testimonial-img img {
    width: 70px;      /* change size here */
    height: 70px;
    object-fit: cover;
    border-radius: 50%; /* keeps circle shape */
}
.testimonial-sc .testimonial-au .testimonial-img {
    position: absolute !important;
    left: -10px !important;
    top: 0px !important;
}
/* Partner Box Container */
.partner-box {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 110px;
    padding: 15px;
    background: #ffffff;
    border-radius: 12px;
    transition: all 0.3s ease;
    text-decoration: none;
}

/* Hover Effect */
.partner-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}

/* Partner Logo */
.partner-logo {
    max-height: 70px;
    width: auto;
    object-fit: contain;
}

/* Partner Name Styling */
.partner-name {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;

    font-size: 20px;
    font-weight: 600;
    color: #606061;
    letter-spacing: 0.5px;
    line-height: 1.4;

    padding: 10px 12px;
    width: 100%;


    border-radius: 8px;
}

/* Optional Initial Letter Highlight */
.partner-name::first-letter {
    color: #ff5e14;   /* Theme color */
    font-size: 18px;
    font-weight: 700;
}


</style>
@endsection
@section('content')



    <!-- Content -->
	<div class="page-content">
		<!-- Main Slider -->
        <div class="rev-slider">
            <div id="rev_slider_265_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container errow-style-1"
                data-alias="" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">

                <!-- START REVOLUTION SLIDER 5.4.6.3 fullwidth mode -->
                <div id="rev_slider_265_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.6.3">
                    <ul>
                        @php
                            // Get hero data
                            $hero = App\Models\HeroSection::latest()->first();
                        @endphp

                        @if($hero && $hero->type == 1 && $hero->hero_with_images)
                            @php
                                // Decode the JSON data
                                $slides = json_decode($hero->hero_with_images, true);
                                $slideIndex = 100; // Starting index for slides
                            @endphp

                            @foreach($slides as $index => $slide)
                                @if(isset($slide['image']) && !empty($slide['image']))
                                    <li data-index="rs-{{ $slideIndex }}" data-transition="fade" data-slotamount="default"
                                        data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                                        data-easeout="default" data-masterspeed="300"
                                        data-thumb="{{ asset('storage/'.$slide['image']) }}" data-rotate="0"
                                        data-saveperformance="off" data-title="{{ $slide['title'] ?? '' }}"
                                        data-param1="" data-param2="" data-param3="" data-param4="" data-param5=""
                                        data-param6="" data-param7="" data-param8="" data-param9="" data-param10=""
                                        data-description="">

                                        <!-- MAIN IMAGE -->
                                        <img src="{{ asset('storage/'.$slide['image']) }}" alt="{{ $slide['title'] ?? '' }}"
                                             data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                             class="rev-slidebg" data-no-retina>

                                        @if(isset($slide['title']) && !empty($slide['title']))
                                            <!-- LAYER NR. 1 - TITLE -->
                                            <div class="tp-caption tp-resizeme text-white"
                                                id="slide-{{ $slideIndex }}-layer-1"
                                                data-x="380"
                                                data-y="200"
                                                data-width="['auto']"
                                                data-height="['auto']"
                                                data-type="text"
                                                data-responsive_offset="on"
                                                data-frames='[{"delay":"+500","split":"chars","splitdelay":0.05000000000000000277555756156289135105907917022705078125,"speed":2000,"split_direction":"forward","frame":"0","from":"opacity:0;","color":"#000000","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":2000,"frame":"999","color":"transparent","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-textAlign="['left','left','left','left']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[0,0,0,0]"
                                                data-paddingbottom="[0,0,0,0]"
                                                data-paddingleft="[0,0,0,0]"
                                                data-fontsize="['70','80','40','40']"
                                                data-lineheight="['80','80','40','40']"
                                                style="z-index: 6; white-space: nowrap; font-size: 62px; line-height: 80px; font-weight: 700; letter-spacing: 0px; font-family:'Poppins', sans-serif;">
                                                {{ $slide['title'] }}
                                            </div>
                                        @endif

                                        @if(isset($slide['content']) && !empty($slide['content']))
                                            <!-- LAYER NR. 2 - CONTENT -->
                                            <div class="tp-caption tp-resizeme"
                                                id="slide-{{ $slideIndex }}-layer-2"
                                                data-x="380"
                                                data-y="380"
                                                data-width="['700','700','700','700']"
                                                data-height="['auto']"
                                                data-type="text"
                                                data-responsive_offset="on"
                                                data-frames='[{"delay":"+1990","speed":2000,"frame":"0","from":"opacity:0;","color":"#e5452b","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","color":"transparent","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[0,0,0,0]"
                                                data-paddingbottom="[0,0,0,0]"
                                                data-paddingleft="[0,0,0,0]"
                                                style="z-index: 7; white-space: normal; font-size: 20px; line-height: 30px; font-weight: 500; color: #fff; letter-spacing: 0px;font-family:Montserrat;text-transform:uppercase;">
                                                {{ $slide['content'] }}
                                            </div>
                                        @endif



                                        <a href="{{ route('web.about') }}" class="tp-caption tp-resizeme site-button"
                                        id="slide-200-layer-3"
                                        data-x="380"
                                        data-y="480"
                                        data-width="['auto']"
                                        data-height="['auto']"
                                        data-type="button"
                                        data-actions=''
                                        data-responsive_offset="on"
                                        data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power0.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]'
                                        data-textAlign="['inherit','inherit','inherit','inherit']"
                                        data-paddingtop="[13,0,0,0]"
                                        data-paddingright="[38,0,0,0]"
                                        data-paddingbottom="[13,0,0,0]"
                                        data-paddingleft="[38,0,0,0]"
                                        style="z-index: 10; white-space: nowrap; line-height: 30px; font-weight: 600; font-family:'Raleway', sans-serif;border-radius:0px 0px 0px 0px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none;">Know Us</a>
                                    <a href="{{ route('web.contact') }}" class="tp-caption tp-resizeme site-button white"
                                        id="slide-200-layer-4"
                                        data-x="570"
                                        data-y="480"
                                        data-width="['auto']"
                                        data-height="['auto']"
                                        data-type="button"
                                        data-actions=''
                                        data-responsive_offset="on"
                                        data-frames='[{"delay":2500,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power0.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]'
                                        data-textAlign="['inherit','inherit','inherit','inherit']"
                                        data-paddingtop="[13,0,0,0]"
                                        data-paddingright="[38,0,0,0]"
                                        data-paddingbottom="[13,0,0,0]"
                                        data-paddingleft="[38,0,0,0]"
                                        style="z-index: 11; white-space: nowrap; font-size: 16px; line-height: 30px; font-weight: 600; font-family:'Raleway', sans-serif;border-radius:0px 0px 0px 0px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none;">Talk To US</a>
                                    </li>
                                    @php $slideIndex += 100; @endphp
                                @endif
                            @endforeach

                        @else
                            <!-- Default/Backup Slides if no hero data exists -->
                            <li data-index="rs-100" data-transition="fade" data-slotamount="default"
                                data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                                data-easeout="default" data-masterspeed="300"
                                data-thumb="{{ asset('Website/images/main-slider/slide2.jpg') }}" data-rotate="0"
                                data-saveperformance="off" data-title="Slide" data-param1="" data-param2=""
                                data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                                data-param8="" data-param9="" data-param10="" data-description="">

                                <img src="{{ asset('Website/images/main-slider/slide2.jpg') }}" alt=""
                                     data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                     class="rev-slidebg" data-no-retina>

                                <div class="tp-caption tp-resizeme text-white"
                                    id="slide-100-layer-1"
                                    data-x="380"
                                    data-y="200"
                                    data-width="['auto']"
                                    data-height="['auto']"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-frames='[{"delay":"+500","split":"chars","splitdelay":0.05000000000000000277555756156289135105907917022705078125,"speed":2000,"split_direction":"forward","frame":"0","from":"opacity:0;","color":"#000000","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":2000,"frame":"999","color":"transparent","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['left','left','left','left']"
                                    data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]"
                                    data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]"
                                    data-fontsize="['70','80','40','40']"
                                    data-lineheight="['80','80','40','40']"
                                    style="z-index: 6; white-space: nowrap; font-size: 62px; line-height: 80px; font-weight: 700; letter-spacing: 0px; font-family:'Poppins', sans-serif;">
                                    Theme for Construction  <br/>& Building Services
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-100-layer-2"
                                    data-x="380"
                                    data-y="380"
                                    data-width="['700','700','700','700']"
                                    data-height="['auto']"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-frames='[{"delay":"+1990","speed":2000,"frame":"0","from":"opacity:0;","color":"#e5452b","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","color":"transparent","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]"
                                    data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]"
                                    style="z-index: 7; white-space: normal; font-size: 20px; line-height: 30px; font-weight: 500; color: #fff; letter-spacing: 0px;font-family:Montserrat;text-transform:uppercase;">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry
                                </div>

                                <a href="#" class="tp-caption tp-resizeme site-button"
                                    id="slide-100-layer-3"
                                    data-x="380"
                                    data-y="480"
                                    data-width="['auto']"
                                    data-height="['auto']"
                                    data-type="button"
                                    data-actions=''
                                    data-responsive_offset="on"
                                    data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power0.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[13,0,0,0]"
                                    data-paddingright="[38,0,0,0]"
                                    data-paddingbottom="[13,0,0,0]"
                                    data-paddingleft="[38,0,0,0]"
                                    style="z-index: 10; white-space: nowrap; line-height: 30px; font-weight: 600; font-family:'Raleway', sans-serif;border-radius:0px 0px 0px 0px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none;">
                                    Get A Quote
                                </a>



                                <!-- CONSTANT BUTTON 2 -->
                                <a href="/contact" class="tp-caption tp-resizeme site-button white"
                                    id="slide-100-constant-btn-2"
                                    data-x="770"
                                    data-y="480"
                                    data-width="['auto']"
                                    data-height="['auto']"
                                    data-type="button"
                                    data-responsive="on"
                                    data-responsive_offset="on"
                                    data-frames='[{"delay":2500,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power0.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[13,0,0,0]"
                                    data-paddingright="[38,0,0,0]"
                                    data-paddingbottom="[13,0,0,0]"
                                    data-paddingleft="[38,0,0,0]"
                                    style="z-index: 13; white-space: nowrap; font-size: 16px; line-height: 30px; font-weight: 600; font-family:'Raleway', sans-serif;border-radius:0px 0px 0px 0px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none;background:#333;color:#fff;">
                                    Contact Us
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                </div>
            </div>
        </div>
        <!-- Main Slider -->
		<!-- content-area -->
		<div class="content-block">
            <div class="section-full content-inner-1 blog-sc cat-1">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-head text-center">
                                <h2>Services</h2>
                                <div class="divider-sc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="blog-carousel owl-carousel owl-theme owl-none">
                                @if(isset($services) && $services->count())
                                    @foreach($services as $service)
                                        <div class="item">
                                            <div class="blog-post blog-grid">
                                                <div class="dez-post-media dez-img-effect">
                                                    <a href="{{ route('web.service.single', $service->slug) }}">
                                                        <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('Website/images/service/service-1.jpg') }}"
                                                             alt="{{ $service->title ?? 'Service Image' }}">
                                                    </a>
                                                </div>
                                                <div class="dez-info">
                                                    <div class="dez-post-title">
                                                        <h5 class="post-title">
                                                            <a href="{{ route('web.service.single', $service->slug) }}">
                                                                {{ $service->title ?? 'Service Title' }}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="dez-post-text">
                                                        <p>{{ $service->short_description ?? 'Lorem Ipsum dummy text.' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- Optional fallback if no services exist --}}
                                    <div class="item">
                                        <div class="blog-post blog-grid">
                                            <div class="dez-post-media dez-img-effect">
                                                <a href="#"><img src="{{ asset('Website/images/service/service-1.jpg') }}" alt="Service"></a>
                                            </div>
                                            <div class="dez-info">
                                                <div class="dez-post-title">
                                                    <h5 class="post-title"><a href="#">No Services Available</a></h5>
                                                </div>
                                                <div class="dez-post-text">
                                                    <p>Please check back later.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


			<!-- about and faq -->
			<div class="section-full content-inner">
                <div class="container">

                    {{-- Section Head --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="section-head text-center">
                                <h2>About us & FAQ's</h2>
                                <div class="divider-sc"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        {{-- ABOUT --}}
                        <div class="{{ $faqs->count() ? 'col-lg-6' : 'col-lg-12' }} sc-about">

                            <h5>
                                {{ $about->title ?? 'About Us' }}
                            </h5>

                            <p>
                                {!! $about->description ?? 'No description added yet.' !!}
                            </p>

                            <div class="d-flex">
                                <div class="m-r50 align-self-center">
                                    <a href="#" class="site-button">Know More</a>
                                </div>
                            </div>

                        </div>


                        {{-- FAQ (Show only if exists) --}}
                        @if($faqs->count())
                            <div class="col-lg-6">

                                <div class="dez-accordion box-sort-in space active-bg accdown1" id="accordion001">

                                    @foreach($faqs as $key => $faq)
                                        <div class="panel">

                                            {{-- Head --}}
                                            <div class="acod-head">
                                                <h6 class="acod-title">
                                                    <a
                                                       data-toggle="collapse"
                                                       data-target="#collapse{{ $key }}"
                                                       class="{{ $key != 0 ? 'collapsed' : '' }}"
                                                       aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">

                                                       {{ $faq->question }}
                                                    </a>
                                                </h6>
                                            </div>

                                            {{-- Body --}}
                                            <div id="collapse{{ $key }}"
                                                 class="acod-body collapse {{ $key == 0 ? 'show' : '' }}"
                                                 data-parent="#accordion001">

                                                <div class="acod-content">
                                                    <p>{!! $faq->answer !!}</p>
                                                </div>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        @endif

                    </div>
                </div>
            </div>

			<!-- about and faq end -->
			<!-- counter -->
			<div class="section-full counter-sc text-center">
                <div class="container border-tp content-inner">
                    <div class="row">

                        @php
                            // Safe handling
                            $stats = [];

                            if(isset($about) && $about->stats){
                                // If already array
                                if(is_array($about->stats)){
                                    $stats = $about->stats;
                                }
                                // If JSON string
                                else{
                                    $stats = json_decode($about->stats, true) ?? [];
                                }
                            }
                        @endphp

                        {{-- Projects --}}
                        <div class="col-lg-3 col-sm-6 count-mr">
                            <div class="counter-item">
                                <div class="counter-out-sc">
                                    <span class="counter">
                                        {{ $stats['no_of_projects'] ?? 0 }}
                                    </span>
                                </div>
                                <h5 class="counter-text">Successful Projects</h5>
                            </div>
                        </div>

                        {{-- Experience --}}
                        <div class="col-lg-3 col-sm-6 count-mr">
                            <div class="counter-item">
                                <div class="counter-out-sc">
                                    <span class="counter">
                                        {{ $stats['years_of_experience'] ?? 0 }}
                                    </span>+
                                </div>
                                <h5 class="counter-text">Years of Experience</h5>
                            </div>
                        </div>

                        {{-- Employees --}}
                        <div class="col-lg-3 col-sm-6 count-mr">
                            <div class="counter-item">
                                <div class="counter-out-sc">
                                    <span class="counter">
                                        {{ $stats['no_of_employees'] ?? 0 }}
                                    </span>+
                                </div>
                                <h5 class="counter-text">Employees</h5>
                            </div>
                        </div>

                        {{-- Clients --}}
                        <div class="col-lg-3 col-sm-6 count-mr">
                            <div class="counter-item">
                                <div class="counter-out-sc">
                                    <span class="counter">
                                        {{ $stats['no_of_satisfied_clients'] ?? 0 }}
                                    </span>
                                </div>
                                <h5 class="counter-text">Satisfied Clients</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


			<!-- counter end -->
			<!-- testimonial -->
			<div class="section-full testimonial-sc content-inner-2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-head text-center text-white">
                                <h2>Testimonials</h2>
                                <div class="divider-sc"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="testimonial-3 owl-carousel owl-theme owl-loaded owl-btn-2 owl-btn-center-lr">

                                @if(isset($testimonials) && $testimonials->count())

                                    @foreach($testimonials as $testimonial)
                                        <div class="item">

                                            <div class="quote">
                                                <div class="quote-right"></div>
                                            </div>

                                            <div class="testimonial-au">
                                                <div class="testimonial-img">
                                                    <a href="#">
                                                        <img src="{{ $testimonial->image
                                                            ? asset('storage/' . $testimonial->image)
                                                            : asset('Website/images/item/pic1.png') }}"
                                                             alt="{{ $testimonial->name }}">
                                                    </a>
                                                </div>

                                                <h4>{{ $testimonial->name }}</h4>

                                                <a href="#">
                                                    <p>{{ $testimonial->designation }}</p>
                                                </a>
                                            </div>

                                            <div class="testimonial-cont">
                                                <p>{{ $testimonial->message }}</p>
                                            </div>

                                        </div>
                                    @endforeach

                                @else

                                    {{-- Fallback (editor default if no data) --}}
                                    <div class="item">
                                        <div class="quote">
                                            <div class="quote-right"></div>
                                        </div>
                                        <div class="testimonial-au">
                                            <div class="testimonial-img">
                                                <a href="#"><img src="{{asset('Website/images/item/pic1.png')}}" alt=""></a>
                                            </div>
                                            <h4>Jenifer Hearly</h4>
                                            <a href="#"><p>Newyork</p></a>
                                        </div>
                                        <div class="testimonial-cont">
                                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                        </div>
                                    </div>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<!-- testimonial end -->
			<!-- project -->
			<div class="section-full content-inner-1 project">
                <div class="container">
                    <div class="row">

                        {{-- Left Content --}}
                        <div class="col-lg-3 align-self-center">
                            <div class="section-head sc-left">
                                <h2>Latest Project</h2>
                                <div class="divider-sc"></div>
                                <p class="m-b15">
                                    Explore some of our recently completed projects and works.
                                </p>

                                <div class="link">
                                    <a href="{{ route('web.portfolio') }}" class="btn btn-link">
                                        More Projects <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Right Slider --}}
                        <div class="col-lg-9">
                            <div class="testimonial-3 owl-carousel owl-theme owl-btn-center-lr">

                                @forelse($portfolios as $portfolio)
                                    <div class="item proj-style">
                                        <div class="proj-bx">
                                            <div class="proj-img">

                                                {{-- Image --}}
                                                <img src="{{ asset('storage/'.$portfolio->banner_image) }}"
                                                     alt="{{ $portfolio->title }}" />

                                                <div class="overlay-eff">
                                                    <div class="proj-sc">
                                                        <div class="proj-cont">

                                                            {{-- Link --}}
                                                            <div class="proj-top">
                                                                <a href="{{ route('web.portfolio.single', $portfolio->slug) }}">
                                                                    <i class="fa fa-link"></i>
                                                                </a>

                                                            </div>

                                     {{-- Title --}}
                                                            <div class="proj-bottom">
                                                                <div class="title text-center">
                                                                    <h4>{{ $portfolio->title }}</h4>

                                                                    <span>
                                                                        {{ $portfolio->category->title ?? 'Project' }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="item">
                                        <p class="text-center">No projects found.</p>
                                    </div>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
            </div>

			<!-- project end -->
			<!-- blog -->
			<div class="section-full content-inner-1 blog-sc cat-1">
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
                            <div class="blog-carousel owl-carousel owl-theme owl-none">

                                @foreach($blogs as $blog)
                                <div class="item">
                                    <div class="blog-post blog-grid">

                                        {{-- Image --}}
                                        <div class="dez-post-media dez-img-effect">
                                            <a href="{{ route('web.blog.single', $blog->slug) }}">
                                                <img src="{{ $blog->image
                                                    ? asset('storage/'.$blog->image)
                                                    : asset('Website/images/blog/image-1.jpg') }}"
                                                    alt="{{ $blog->title }}">
                                            </a>
                                        </div>

                                        <div class="dez-info">

                                            {{-- Meta --}}
                                            <div class="dez-post-meta">
                                                By {{ $blog->written_by ?? 'Admin' }}
                                                | {{ $blog->created_at->format('F d, Y') }}
                                            </div>

                                            {{-- Title --}}
                                            <div class="dez-post-title">
                                                <h5 class="post-title">
                                                    <a href="{{ route('web.blog.single', $blog->slug) }}">
                                                        {{ $blog->title }}
                                                    </a>
                                                </h5>
                                            </div>

                     {{-- Short Desc --}}
                                            <div class="dez-post-text">
                                                <p>
                                                    {{ Str::limit($blog->short_description, 100) }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<!-- blog end -->
			<!-- partner -->
			<div class="section-full content-inner-2 client-sc">
                <div class="container">

                    {{-- Section Head --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="section-head client">
                                <h2>Our Partners</h2>
                                <div class="divider-sc"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="client-logo-carousel owl-carousel owl-theme gallery owl-btn-1">

                                @forelse($partners as $partner)
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo text-center">

                                            @php
                                            $imagePath = public_path('storage/' . $partner->image);
                                        @endphp

                                        @if(!empty($partner->image) && file_exists($imagePath))

                                            <a href="#" class="partner-box">
                                                <img
                                                    src="{{ asset('storage/'.$partner->image) }}"
                                                    alt="{{ $partner->name }}"
                                                    class="partner-logo"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                                >

                                                {{-- Name fallback --}}
                                                <div class="partner-name" style="display:none;">
                                                    {{ $partner->name }}
                                                </div>
                                            </a>

                                        @else

                                            <a href="#" class="partner-box">
                                                <div class="partner-name">
                                                    {{ $partner->name }}
                                                </div>
                                            </a>

                                        @endif


                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="item text-center">
                                    <p>No partners added yet.</p>
                                </div>
                            @endforelse


                            </div>

                        </div>
                    </div>

                </div>
            </div>

			<!-- partner end -->

		</div>
		<!-- content-area end -->
	</div>

    @endsection