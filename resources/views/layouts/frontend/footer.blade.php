<!-- Footer -->
@php
    $types = [
        3 => 'Services',
        7 => 'Projects',
        8 => 'Blog',
        9 => 'Career',
        10 => 'Contact'
    ];

    $routes = [
        3 => 'web.services',
        7 => 'web.portfolio',
        8 => 'web.blog',
        9 => 'web.career',
        10 => 'web.contact'
    ];
@endphp

<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Logo & About -->
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="widget">
                        <img src="{{ asset($siteSetting && $siteSetting->logo_image ? 'storage/'.$siteSetting->logo_image : 'Website/images/logo2.png') }}"
                             class="footer-logo"
                             alt="{{ $siteSetting && $siteSetting->company_name ? $siteSetting->company_name : 'Company Logo' }}"
                             style="max-height:80px; object-fit:contain;" />

                        <p class="text-capitalize m-b20">
                            {{ $siteSetting && $siteSetting->footer_text ? $siteSetting->footer_text : "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s." }}
                        </p>
                        <div class="link">
                            <a href="{{ route('web.portfolio') }}" class="btn btn-link">More Projects <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Services / What We Do -->
                <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                    <div class="widget border-0">
                        <h4>Our Services</h4>
                        <div class="divider-sc"></div>
                        <ul class="list-line">
                            @if(isset($services) && $services->count())
                                @foreach($services as $service)
                                    <li>
                                        <a href="{{ route('web.service.single', $service->slug) }}">{{ $service->title }}</a>
                                    </li>
                                @endforeach
                            @else
                                <li><a href="javascript:void(0);">Construct</a></li>
                                <li><a href="javascript:void(0);">Building Design</a></li>
                                <li><a href="javascript:void(0);">Safety</a></li>
                                <li><a href="javascript:void(0);">Renovation</a></li>
                                <li><a href="javascript:void(0);">Architecture</a></li>
                                <li><a href="javascript:void(0);">Home Design</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Navigation Links / Find Links -->
                <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                    <div class="widget border-0">
                        <h4>Find Links</h4>
                        <div class="divider-sc"></div>
                        <ul class="list-line">
                            @if(isset($pages) && $pages->count())
                                @foreach($pages as $page)
                                    @if(in_array($page->type, [3,7,8,9,10]))
                                        <li>
                                            <a href="{{ isset($routes[$page->type]) ? route($routes[$page->type]) : '#' }}">
                                                {{ $types[$page->type] ?? 'Unknown' }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                <li><a href="{{ route('web.home') }}">Home</a></li>
                                <li><a href="{{ route('web.about') }}">About Us</a></li>
                                <li><a href="{{ route('web.services') }}">Services</a></li>
                                <li><a href="{{ route('web.portfolio') }}">Projects</a></li>
                                <li><a href="{{ route('web.blog') }}">Blog</a></li>
                                <li><a href="{{ route('web.career') }}">Career</a></li>
                                <li><a href="{{ route('web.contact') }}">Contact</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                    <div class="widget widget_getintuch" style="background-image: url('{{ asset('Website/images/background/map.png') }}'); background-position:left bottom; background-repeat: no-repeat;">
                        <h4>Contact us</h4>
                        <div class="divider-sc"></div>
                        <ul>
                            <li><i class="ti-location-pin"></i>{{ $siteSetting && $siteSetting->address ? $siteSetting->address : 'Demo address #8901 Marmora Road Chi Minh City, Vietnam' }}</li>
                            <li><i class="ti-mobile"></i>
                                {{ $siteSetting && $siteSetting->primary_mobile_no ? $siteSetting->primary_mobile_no : '0800-123456 (24/7 Support Line)' }}
                                @if($siteSetting && $siteSetting->secondary_mobile_no)
                                    , {{ $siteSetting->secondary_mobile_no }}
                                @endif
                            </li>
                            <li><i class="ti-email"></i>
                                {{ $siteSetting && $siteSetting->primary_email ? $siteSetting->primary_email : 'info@example.com' }}
                                @if($siteSetting && $siteSetting->secondary_email)
                                    , {{ $siteSetting->secondary_email }}
                                @endif
                            </li>
                        </ul>
                        <ul class="list-inline">
                            @if($siteSetting && $siteSetting->facebook_link)
                                <li><a href="{{ $siteSetting->facebook_link }}" class="site-button-link facebook hover" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            @endif
                            @if($siteSetting && $siteSetting->google_link)
                                <li><a href="{{ $siteSetting->google_link }}" class="site-button-link google-plus hover" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            @endif
                            @if($siteSetting && $siteSetting->linkedin_link)
                                <li><a href="{{ $siteSetting->linkedin_link }}" class="site-button-link linkedin hover" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            @endif
                            @if($siteSetting && $siteSetting->instagram_link)
                                <li><a href="{{ $siteSetting->instagram_link }}" class="site-button-link instagram hover" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            @endif
                            @if($siteSetting && $siteSetting->twitter_link)
                                <li><a href="{{ $siteSetting->twitter_link }}" class="site-button-link twitter hover" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <span>
                        Copyrights © {{ date('Y') }} All Rights Reserved by
                        <a href="https://techspireinnovation.com.np/" target="_blank">Techspire Innovation Pvt. Ltd</a>
                    </span>
                </div>
                <div class="col-lg-6">
                    <ul class="footer-info-list text-right">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Help Desk</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- scroll top button -->
<button class="scroltop fa fa-arrow-up"></button>
</div>
