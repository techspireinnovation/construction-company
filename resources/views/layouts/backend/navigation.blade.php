<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" data-bs-theme="light">
    <!-- LOGO -->
    <div class="navbar-brand-box" data-sidebar-brand>
        <!-- Dark Logo-->
        <a href="{{ route('web.home') }}" class="logo logo-dark" data-theme-logo="dark">
            <span class="logo-sm">
                <img src="{{ asset('Backend/assets/images/logo-sm.png') }}" alt="Logo" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('Backend/assets/images/logo-dark.png') }}" alt="Logo Dark" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('web.home') }}" class="logo logo-light" data-theme-logo="light">
            <span class="logo-sm">
                <img src="{{ asset('Backend/assets/images/logo-sm.png') }}" alt="Logo" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('Backend/assets/images/logo-light.png') }}" alt="Logo Light" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover" data-theme-btn>
            <i class="ri-record-circle-line" data-theme-icon></i>
        </button>
    </div>

    <div id="scrollbar" data-sidebar-scroll>
        <div class="container-fluid" style="margin-bottom: 85px;">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav" data-sidebar-nav>

                <li class="menu-title" data-sidebar-title><span data-key="t-menu">Menu</span></li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}" data-nav-link>
                        <i data-feather="home" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-dashboards" data-nav-text>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title" data-sidebar-title>
                    <i class="ri-more-fill" data-title-icon></i>
                    <span data-key="t-pages">Content Management</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.hero-sections.*') ? 'active' : '' }}"
                       href="{{ route('admin.hero-sections.index') }}" data-nav-link>
                        <i data-feather="settings" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-settings" data-nav-text>Hero Section</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}"
                       href="{{ route('admin.pages.index') }}" data-nav-link>
                        <i data-feather="file-text" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-pages-seo" data-nav-text>Pages SEO</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.abouts.*') ? 'active' : '' }}"
                       href="{{ route('admin.abouts.index') }}" data-nav-link>
                        <i data-feather="info" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-abouts" data-nav-text>About</span>
                    </a>
                </li>

                <!-- Partners -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}"
                       href="{{ route('admin.partners.index') }}" data-nav-link>
                        <i data-feather="users" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-partners" data-nav-text>Partner</span>
                    </a>
                </li>

                <!-- Why Choose Us -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.why_choose_us.*') ? 'active' : '' }}"
                       href="{{ route('admin.why_choose_us.index') }}" data-nav-link>
                        <i data-feather="thumbs-up" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-why-choose-us" data-nav-text>Why Choose Us</span>
                    </a>
                </li>

                <!-- Faqs -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"
                       href="{{ route('admin.faqs.index') }}" data-nav-link>
                        <i data-feather="help-circle" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-faqs" data-nav-text>Faqs</span>
                    </a>
                </li>

                <!-- Testimonials -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                       href="{{ route('admin.testimonials.index') }}" data-nav-link>
                        <i data-feather="message-square" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-testimonials" data-nav-text>Testimonial</span>
                    </a>
                </li>

                <!-- Careers -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.careers.*') ? 'active' : '' }}"
                       href="{{ route('admin.careers.index') }}" data-nav-link>
                        <i data-feather="briefcase" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-jobs" data-nav-text>Career</span>
                    </a>
                </li>

                <!-- Gallery -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}"
                       href="{{ route('admin.galleries.index') }}" data-nav-link>
                        <i data-feather="grid" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-gallery" data-nav-text>Gallery</span>
                    </a>
                </li>

                <!-- Services -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                       href="{{ route('admin.services.index') }}" data-nav-link>
                        <i data-feather="briefcase" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-services" data-nav-text>Services</span>
                    </a>
                </li>

                <!-- Teams -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}"
                       href="{{ route('admin.teams.index') }}" data-nav-link>
                        <i data-feather="users" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-teams" data-nav-text>Teams</span>
                    </a>
                </li>

                {{-- Blog Dropdown --}}
                @php
                    $blogRoutes = ['admin.blog-categories.*', 'admin.blogs.*'];
                @endphp
                <li class="nav-item" data-nav-item>
                    <a class="nav-link menu-link {{ request()->routeIs($blogRoutes) ? 'active' : '' }}"
                       href="#sidebarBlog" data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ request()->routeIs($blogRoutes) ? 'true' : 'false' }}"
                       aria-controls="sidebarBlog" data-nav-link>
                        <i data-feather="book" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-blog" data-nav-text>Blog</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs($blogRoutes) ? 'show' : '' }}"
                         id="sidebarBlog" data-submenu>
                        <ul class="nav nav-sm flex-column" data-submenu-list>
                            <li class="nav-item">
                                <a href="{{ route('admin.blog-categories.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}"
                                   data-key="t-blog-categories" data-submenu-link>
                                    Blog Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blogs.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"
                                   data-key="t-blogs" data-submenu-link>
                                    Blog List
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Portfolio Dropdown --}}
                @php
                    $portfolioRoutes = ['admin.portfolio-categories.*', 'admin.portfolios.*'];
                @endphp
                <li class="nav-item" data-nav-item>
                    <a class="nav-link menu-link {{ request()->routeIs($portfolioRoutes) ? 'active' : '' }}"
                       href="#sidebarPortfolio" data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ request()->routeIs($portfolioRoutes) ? 'true' : 'false' }}"
                       aria-controls="sidebarPortfolio" data-nav-link>
                        <i data-feather="briefcase" class="icon-dual" data-nav-icon></i>
                        <span data-key="t-portfolio" data-nav-text>Portfolio</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs($portfolioRoutes) ? 'show' : '' }}"
                         id="sidebarPortfolio" data-submenu>
                        <ul class="nav nav-sm flex-column" data-submenu-list>
                            <li class="nav-item">
                                <a href="{{ route('admin.portfolio-categories.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.portfolio-categories.*') ? 'active' : '' }}"
                                   data-key="t-portfolio-categories" data-submenu-link>
                                    Portfolio Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.portfolios.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}"
                                   data-key="t-portfolios" data-submenu-link>
                                    Portfolio List
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @php
                $blogRoutes = ['admin.blog-categories.*', 'admin.blogs.*'];
            @endphp
            <li class="nav-item" data-nav-item>
                <a class="nav-link menu-link {{ request()->routeIs($blogRoutes) ? 'active' : '' }}"
                   href="#sidebarBlog" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs($blogRoutes) ? 'true' : 'false' }}"
                   aria-controls="sidebarBlog" data-nav-link>
                    <i data-feather="book" class="icon-dual" data-nav-icon></i>
                    <span data-key="t-blog" data-nav-text>Blog</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs($blogRoutes) ? 'show' : '' }}"
                     id="sidebarBlog" data-submenu>
                    <ul class="nav nav-sm flex-column" data-submenu-list>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-categories.index') }}"
                               class="nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}"
                               data-key="t-blog-categories" data-submenu-link>
                                Blog Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blogs.index') }}"
                               class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"
                               data-key="t-blogs" data-submenu-link>
                                Blog List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @php
    $emailRoutes = ['admin.contact-submissions.*', 'admin.subscriptions.*'];
@endphp


<li class="nav-item" data-nav-item>
    <a class="nav-link menu-link {{ request()->routeIs($emailRoutes) ? 'active' : '' }}"
       href="#sidebarEmail" data-bs-toggle="collapse" role="button"
       aria-expanded="{{ request()->routeIs($emailRoutes) ? 'true' : 'false' }}"
       aria-controls="sidebarEmail" data-nav-link>
        <i data-feather="mail" class="icon-dual" data-nav-icon></i>
        <span data-key="t-email" data-nav-text>Email Submissions</span>
    </a>
    <div class="collapse menu-dropdown {{ request()->routeIs($emailRoutes) ? 'show' : '' }}"
         id="sidebarEmail" data-submenu>
        <ul class="nav nav-sm flex-column" data-submenu-list>
            <li class="nav-item">
                <a href="{{ route('admin.contact-submissions.index') }}"
                   class="nav-link {{ request()->routeIs('admin.contact-submissions.*') ? 'active' : '' }}"
                   data-key="t-contact-submissions" data-submenu-link>
                    Contact Submissions
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.subscriptions.index') }}"
                   class="nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}"
                   data-key="t-subscriptions" data-submenu-link>
                    Subscription List
                </a>
            </li>
        </ul>
    </div>
</li>


<!-- Site Config -->
<li class="nav-item">
    <a class="nav-link menu-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}"
       href="{{ route('admin.site-settings.index') }}" data-nav-link>
        <i data-feather="settings" class="icon-dual" data-nav-icon></i>
        <span data-key="t-settings" data-nav-text>Site Config</span>
    </a>
</li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background" data-sidebar-bg></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay" data-theme-overlay></div>