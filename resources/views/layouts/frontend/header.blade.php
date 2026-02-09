<style>
    /* Make arrow separate and clickable */
    .dropdown-toggle-icon {
        margin-left: 5px;
        cursor: pointer;
    }
    @media only screen and (max-width: 991px) {
    .nav.navbar-nav li.active a i.fa-chevron-down {
        color: #000000;
    }
}
</style>
<!-- header -->
<header class="site-header mo-left header fullwidth">
    <div class="top-bar bg-dark">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="dez-topbar-left">
                    <ul>
                        <li>
                            <i class="fa fa-phone m-r10"></i>
                            <span>
                                Phone: {{ $siteSetting->primary_mobile_no ?? '+123-456-7890' }}
                            </span>
                        </li>

                        <li>
                            <i class="fa fa-envelope-o m-r10"></i>
                            <span>
                                {{ $siteSetting->primary_email ?? 'info@example.com' }}
                            </span>
                        </li>

                        <li>
                            <i class="fa fa-globe m-r10"></i>
                            <span>
                                {{ $siteSetting->address ?? 'Apple St, New York, NY 10012, USA' }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="dez-topbar-right topbar-social">
                    <ul>

                        <li>
                            <a href="{{ optional($siteSetting)->facebook_link ?? '#' }}"
                               class="site-button-link"
                               target="_blank"
                               rel="noopener noreferrer">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a href="{{ optional($siteSetting)->linkedin_link ?? '#' }}"
                               class="site-button-link"
                               target="_blank"
                               rel="noopener noreferrer">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>

                        <li>
                            <a href="{{ optional($siteSetting)->whatsapp_link ?? '#' }}"
                               class="site-button-link"
                               target="_blank"
                               rel="noopener noreferrer">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                        </li>

                        <li>
                            <a href="{{ optional($siteSetting)->instagram_link ?? '#' }}"
                               class="site-button-link"
                               target="_blank"
                               rel="noopener noreferrer">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                    </ul>
                </div>


            </div>
        </div>
    </div>
    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container clearfix">
                <!-- website logo -->
                <div class="logo-header mostion">
                    <a href="{{ route('web.home') }}">
                        <img src="{{ asset($siteSetting && $siteSetting->logo_image ? 'storage/'.$siteSetting->logo_image : 'Website/images/logo.png') }}"
                             class="logo"
                             alt=""
                             style="height:40px; width:auto;">
                    </a>

                </div>

                <!-- nav toggle button for mobile -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <div class="hdr-sitebtn">
                            <a href="#" class="site-button">Get a quote</a>
                        </div>
                    </div>
                </div>

                <!-- Quik search -->
                <div class="dez-quik-search bg-primary">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                        <span id="quik-search-remove"><i class="fa fa-remove"></i></span>
                    </form>
                </div>

                <!-- main nav -->
                @php
                    $types = [
                        1 => 'Home', 2 => 'About Us', 3 => 'Services', 4 => 'Team',
                        5 => 'Testimonial', 6 => 'Gallery', 7 => 'Projects', 8 => 'Blog',
                        9 => 'Career', 10 => 'Contact'
                    ];

                    $routes = [
                        1 => 'web.home', 2 => 'web.about', 3 => 'web.services', 4 => 'web.team',
                        5 => 'web.testimonial', 6 => 'web.gallery', 7 => 'web.portfolio', 8 => 'web.blog',
                        9 => 'web.career', 10 => 'web.contact'
                    ];

                    // Get active services for dropdown
                    $services = App\Models\Service::where('status', 1)->get();
                @endphp

<div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
    <ul class="nav navbar-nav">
        @if(isset($pages) && $pages->count())
            @foreach($pages->where('parent_id', null) as $page)
                <li class="{{ request()->routeIs($routes[$page->type] ?? '') ? 'active' : '' }}">
                    @php
                        // Check if this is About Us (type 2) or Services (type 3)
                        $isAboutUs = $page->type == 2;
                        $isServices = $page->type == 3;
                        $hasChildren = $page->children->count();
                        $alwaysHasDropdown = $isAboutUs || $isServices;
                    @endphp

                    @if($hasChildren || $alwaysHasDropdown)
                        <!-- Parent item with dropdown - only hash link -->
                        <a href="#">
                            {{ $types[$page->type] ?? 'Unknown' }}
                            <!-- Dropdown toggle icon -->
                            <span class="dropdown-toggle-icon">
                                <i class="fa fa-chevron-down"></i>
                            </span>
                        </a>
                    @else
                        <!-- Regular item without dropdown -->
                        <a href="{{ route($routes[$page->type] ?? '#') }}">
                            {{ $types[$page->type] ?? 'Unknown' }}
                        </a>
                    @endif

                    @if($hasChildren || $alwaysHasDropdown)
                        <ul class="sub-menu">
                            @if($isAboutUs)
                                <!-- Always show About us in dropdown -->
                                <li><a href="{{ route('web.about') }}">About us</a></li>
                            @endif

                            @if($isServices)
                                <!-- Always show View all services in dropdown -->
                                <li><a href="{{ route('web.services') }}">View all the services</a></li>

                                <!-- Show actual services from database -->
                                @if(isset($services) && $services->count())
                                    @foreach($services as $service)
                                        <li>
                                            <a href="{{ route('web.service.single', $service->slug) }}">
                                                {{ $service->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            @endif

                            @if($hasChildren)
                                @foreach($page->children as $child)
                                    <li>
                                        <a href="{{ route($routes[$child->type] ?? '#') }}">
                                            {{ $types[$child->type] ?? 'Unknown' }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endif
                </li>
            @endforeach
        @else
            <!-- Fallback hardcoded menu -->
            <li class="active">
                <a href="{{ route('web.home') }}">Home</a>
            </li>
            <li>
                <a href="#">
                    About us
                    <span class="dropdown-toggle-icon"><i class="fa fa-chevron-down"></i></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('web.about') }}">About us</a></li>
                    <li><a href="{{ route('web.team') }}">Meet Our Team</a></li>
                    <li><a href="{{ route('web.testimonial') }}">Testimonials</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    Services
                    <span class="dropdown-toggle-icon"><i class="fa fa-chevron-down"></i></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('web.services') }}">View all the services</a></li>

                    <!-- Show actual services from database -->
                    @if(isset($services) && $services->count())
                        @foreach($services as $service)
                            <li>
                                <a href="{{ route('web.service.single', $service->slug) }}">
                                    {{ $service->title }}
                                </a>
                            </li>
                        @endforeach

                    @endif
                </ul>
            </li>
            <li><a href="{{ route('web.portfolio') }}">Projects</a></li>
            <li><a href="{{ route('web.blog') }}">Blog</a></li>
            <li><a href="{{ route('web.career') }}">Career</a></li>
            <li><a href="{{ route('web.contact') }}">Contact</a></li>
        @endif
    </ul>
</div>


            </div>
        </div>
    </div>

    <!-- main header END -->
</header>
<!-- header END -->
<script>
    $(document).ready(function() {
        $('.dropdown-toggle-icon').on('click', function(e) {
            e.preventDefault(); // Prevent the link navigation
            e.stopPropagation(); // Stop bubbling

            // Toggle the submenu
            $(this).closest('li').children('.sub-menu').slideToggle();
        });
    });
</script>
