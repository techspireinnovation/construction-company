<!-- header -->
<header class="site-header mo-left header fullwidth">
    <div class="top-bar bg-dark">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="dez-topbar-left">
                    <ul>
                        <li><i class="fa fa-phone m-r10"></i><span> Phone +123-456-7890</span></li>
                        <li><i class="fa fa-envelope-o m-r10"></i><span>info@example.com</span></li>
                        <li><i class="fa fa-globe m-r10"></i><span>Apple St, New York, NY 10012, USA</span></li>
                    </ul>
                </div>
                <div class="dez-topbar-right topbar-social">
                    <ul>
                        <li><a href="#" class="site-button-link"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="site-button-link"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="site-button-link"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="site-button-link"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" class="site-button-link"><i class="fa fa-skype"></i></a></li>
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
                    <a href="index.html"><img src="{{asset('Website/images/logo.png')}}" class="logo" alt=""></a>
                </div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                <div class="dez-quik-search bg-primary ">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                        <span  id="quik-search-remove"><i class="fa fa-remove"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="{{ route('web.home') }}">Home </a>
                        </li>
                        <li>
                            <a href="{{ route('web.about') }}">About us <i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('web.about') }}" class="dez-page">About us</a></li>
                                <li><a href="{{ route('web.team') }}" class="dez-page">Meet Our Team</a></li>
                                <li><a href="{{ route('web.testimonial') }}" class="dez-page">Testimonials</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('web.services') }}">Services <i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="#" class="dez-page">Business Growth</a></li>
                                <li><a href="#" class="dez-page">Sustainability</a></li>
                                <li><a href="#" class="dez-page">Performance</a></li>
                                <li><a href="#" class="dez-page">Advanced Analytics</a></li>
                                <li><a href="#" class="dez-page">Organization</a></li>
                                <li><a href="#" class="dez-page">Customer Insights</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('web.portfolio') }}">Our projects </a>
                        </li>
                        <li>
                            <a href="{{ route('web.blog') }}">Blog</a>

                        </li>
                        <li>
                            <a href="{{ route('web.career') }}">Career</a>

                        </li>
                        <li>
                            <a href="{{ route('web.contact') }}">Contact us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
<!-- header END -->