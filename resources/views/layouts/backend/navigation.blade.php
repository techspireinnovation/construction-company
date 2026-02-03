<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('web.home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('Backend/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('Backend/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('web.home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('Backend/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('Backend/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i data-feather="home" class="icon-dual"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Content Management</span></li>

                <!-- Page Types -->


                <!-- Pages -->


                <!-- Sliders -->

                <!-- Settings -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
                       href="{{ route('admin.site_setting.index') }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span data-key="t-settings">Site Config</span>
                    </a>
                </li>

                <!-- Partners -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}"
                       href="{{ route('admin.partners.index') }}">
                        <i data-feather="users" class="icon-dual"></i>
                        <span data-key="t-partners">Partner</span>
                    </a>
                </li>



                <!-- Why Choose Us -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.why_choose_us.*') ? 'active' : '' }}"
                       href="{{ route('admin.why_choose_us.index') }}">
                        <i data-feather="thumbs-up" class="icon-dual"></i>
                        <span data-key="t-why-choose-us">Why Choose Us</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"
                       href="{{ route('admin.faqs.index') }}">
                        <i data-feather="thumbs-up" class="icon-dual"></i>
                        <span data-key="t-why-choose-us">Faqs</span>
                    </a>
                </li>

                <!-- Testimonials -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                       href="{{ route('admin.testimonials.index') }}">
                        <i data-feather="message-square" class="icon-dual"></i>
                        <span data-key="t-testimonials">Testimonial</span>
                    </a>
                </li>

                <!-- Job -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.careers.*') ? 'active' : '' }}"
                       href="{{ route('admin.careers.index') }}">
                        <i data-feather="briefcase" class="icon-dual"></i>
                        <span data-key="t-jobs">Career</span>
                    </a>
                </li>

                <!-- Gallery -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}"
                       href="{{ route('admin.galleries.index') }}">
                        <i data-feather="grid" class="icon-dual"></i>
                        <span data-key="t-gallery">Gallery</span>
                    </a>
                </li>

                <!-- Services -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                       href="{{ route('admin.services.index') }}">
                        <i data-feather="briefcase" class="icon-dual"></i>
                        <span data-key="t-services">Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}"
                       href="{{ route('admin.teams.index') }}">
                        <i data-feather="briefcase" class="icon-dual"></i>
                        <span data-key="t-services">Teams</span>
                    </a>
                </li>

                <!-- About Sections -->
                @php
                    $aboutRoutes = [
                        'admin.expertises.*',
                        'admin.operations.*',
                        'admin.solutions.*',
                        'admin.benefits.*',
                    ];
                @endphp
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs($aboutRoutes) ? 'active' : '' }}"
                       href="#sidebarAbout" data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ request()->routeIs($aboutRoutes) ? 'true' : 'false' }}"
                       aria-controls="sidebarAbout">
                        <i data-feather="info" class="icon-dual"></i>
                        <span data-key="t-about">Blog</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs($aboutRoutes) ? 'show' : '' }}" id="sidebarAbout">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link {{ request()->routeIs('admin.expertises.*') ? 'active' : '' }}"
                                   data-key="t-expertises">Blog Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link {{ request()->routeIs('admin.operations.*') ? 'active' : '' }}"
                                   data-key="t-operations">Blog List</a>
                            </li>

                        </ul>
                    </div>
                </li>

                {{-- @php
    $blogRoutes = [
        'blog.index', 'blog.create', 'blog.edit',
        'blog_category.index', 'blog_category.create', 'blog_category.edit',
        'blog_category.store', 'blog_category.update', 'blog_category.destroy',
        'blog_category.toggle_status', 'blog_category.bulk_destroy',
    ];
@endphp

<li class="nav-item">
    <a class="nav-link menu-link {{ request()->routeIs($blogRoutes) ? 'active' : '' }}"
       href="#sidebarPages" data-bs-toggle="collapse" role="button"
       aria-expanded="{{ request()->routeIs($blogRoutes) ? 'true' : 'false' }}"
       aria-controls="sidebarPages">
        <i data-feather="command" class="icon-dual"></i> <span data-key="t-pages">Pages</span>
    </a>
    <div class="collapse menu-dropdown {{ request()->routeIs($blogRoutes) ? 'show' : '' }}" id="sidebarPages">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.pages.index') }}" class="nav-link" data-key="t-timeline">Pages Content</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs($blogRoutes) ? 'active' : '' }}"
                   href="#sidebarBlogs" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs($blogRoutes) ? 'true' : 'false' }}"
                   aria-controls="sidebarBlogs">
                    <span data-key="t-blogs">Blogs</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs($blogRoutes) ? 'show' : '' }}" id="sidebarBlogs">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('blog.index') }}"
                               class="nav-link {{ request()->routeIs(['blog.index', 'blog.create', 'blog.edit']) ? 'active' : '' }}"
                               data-key="t-list-view">Blog List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog_category.index') }}"
                               class="nav-link {{ request()->routeIs([
                                    'blog_category.index', 'blog_category.create', 'blog_category.edit',
                                    'blog_category.store', 'blog_category.update', 'blog_category.destroy',
                                    'blog_category.toggle_status', 'blog_category.bulk_destroy'
                                ]) ? 'active' : '' }}"
                               data-key="t-grid-view">Blog Categories</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-key="t-team">Team</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-key="t-faqs">FAQs</a>
            </li>
        </ul>
    </div>
</li> --}}




            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>