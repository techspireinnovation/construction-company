<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Career;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HeroSection;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Page;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;

class FrontendController extends Controller
{
    protected $siteSetting;
    protected $pages;

    public function __construct()
    {
        // Get first settings row
        $this->siteSetting = SiteSetting::first();

        // Get active pages ordered
        $this->pages = Page::where('status', 1)
            ->orderBy('order_no')
            ->get();
    }

    public function indexHome()
    {
        $page = Page::where('type', 1)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        // Generate SEO
        $seoMeta = $this->generateSeo(
            $page,
            'Home Page',                         // default title
            'Know About Us',      // default description
            'Construction Company, Construction company in Nepal',       // default keywords
            asset('Website/images/background/image-1.jpg')
        );
        // Fetch all active services
        $services = Service::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        $testimonials = Testimonial::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        $faqs = Faq::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();
        $partners = Partner::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();
        $about = About::latest()->first();
        $portfolios = Portfolio::with('category')
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->take(10)
            ->get();
        $blogs = Blog::where('status', 1)
            ->latest()
            ->take(10)
            ->get();
        $hero = HeroSection::latest()->first();

        return view(
            'website.index',
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
                'services' => $services,
                'testimonials' => $testimonials,
                'faqs' => $faqs,
                'about' => $about,
                'partners' => $partners,
                'portfolios' => $portfolios,
                'blogs' => $blogs,
                'hero' => $hero,

            ],
            $seoMeta
        );
    }

    public function indexAbout()
    {
        $page = Page::where('type', 2)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,
            'About Us',
            'Learn more about our company and team',
            'about us, company, team',
            asset('Website/images/background/image-1.jpg')
        );

        $about = About::first();

        $teams = Team::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();
        $whyChooseUs = WhyChooseUs::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();
        $blogs = Blog::where('status', 1)
            ->latest()
            ->take(6)
            ->get();
        return view('website.about', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'teams' => $teams,
                'page' => $page,
                'about' => $about,
                'whyChooseUs' => $whyChooseUs,
                'blogs' => $blogs,
            ],
            $seoMeta
        ));
    }


    public function indexTeam()
    {
        // Fetch Team Page (type = 4)
        $page = Page::where('type', 4)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        // Generate SEO
        $seoMeta = $this->generateSeo(
            $page,
            'Our Team',                         // default title
            'Meet our professional team',      // default description
            'team, company team, staff',       // default keywords
            asset('Website/images/background/image-1.jpg')
        );

        $teams = Team::where('status', 1)
            ->whereNull('deleted_at')
            ->orderBy('order_no')
            ->get();

        return view('website.team', array_merge(
            compact('teams', 'page'),
            $seoMeta
        ));
    }


    public function indexTestimonial()
    {
        $page = Page::where('type', 5)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,
            'Testimonials',                        // default title
            'See what our clients say about us',   // default description
            'testimonials, client feedback',       // default keywords
            asset('Website/images/background/image-1.jpg') // default image
        );

        $testimonials = Testimonial::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        return view('website.testimonial', array_merge(
            compact('testimonials', 'page'),
            $seoMeta
        ));
    }


    public function indexBlog()
    {
        $page = Page::where('type', 8)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,
            'Blogs',
            'Read our latest blog posts and updates',
            'blog, articles, news',
            asset('Website/images/background/image-1.jpg')
        );

        $blogs = Blog::where('status', 1)->latest()->paginate(6);
        $categories = BlogCategory::withCount('blogs')->get();
        $recentBlogs = Blog::where('status', 1)->latest()->take(3)->get();

        return view('website.blog', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
                'blogs' => $blogs,
                'categories' => $categories,
                'recentBlogs' => $recentBlogs
            ],
            $seoMeta
        ));
    }
    public function blogSearch()
    {
        $page = Page::where('type', 8) // Blog page type
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,
            'Blogs',
            'Search results for blogs',
            'blog, articles, news',
            asset('Website/images/background/image-1.jpg')
        );

        $query = request('query'); // Get search query

        $blogs = Blog::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('short_description', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(6)
            ->appends(['query' => $query]); // Keep query in pagination links

        $categories = BlogCategory::withCount('blogs')->get();
        $recentBlogs = Blog::where('status', 1)->latest()->take(3)->get();

        return view('website.blog', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
                'blogs' => $blogs,
                'categories' => $categories,
                'recentBlogs' => $recentBlogs,
                'searchQuery' => $query // optional, for showing "Search results for..."
            ],
            $seoMeta
        ));
    }


    public function blogSingle($slug)
    {
        // Fetch blog by slug with category and SEO
        $blog = Blog::with('category', 'seo')->where('slug', $slug)->firstOrFail();

        // SEO meta data
        $seoMeta = $this->generateSeo(
            $blog->seo,
            $blog->title ?? 'Blog Details',
            $blog->short_description ?? 'Read this blog post',
            $blog->seo->seo_keywords ?? 'blog, articles, news',
            $blog->image ? asset('storage/' . $blog->image) : asset('Website/images/background/image-1.jpg')
        );

        return view('website.blog-details', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'blog' => $blog,
            ],
            $seoMeta
        ));
    }
    public function blogCategory($slug)
    {
        // Fetch the Blog Page (type = 8) with SEO
        $page = Page::where('type', 8)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,
            'Blogs',
            'Read our latest blog posts and updates',
            'blog, articles, news',
            asset('Website/images/background/image-1.jpg')
        );

        // Find the category
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        // Get blogs in this category
        $blogs = Blog::where('status', 1)
            ->where('blog_category_id', $category->id)
            ->latest()
            ->paginate(6);

        // Categories with blog counts
        $categories = BlogCategory::withCount('blogs')->get();

        // Recent blogs
        $recentBlogs = Blog::where('status', 1)->latest()->take(3)->get();

        return view('website.blog', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
                'blogs' => $blogs,
                'categories' => $categories,
                'recentBlogs' => $recentBlogs,
                'currentCategory' => $category, // optional for highlighting
            ],
            $seoMeta
        ));
    }


    public function indexContact()
    {
        // Fetch the Contact Page (type = 10) with SEO
        $page = Page::where('type', 10)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,
            'Contact Us',
            'Get in touch with us for any inquiries or support',
            'contact, inquiry, support',
            asset('Website/images/background/image-1.jpg')
        );

        return view('website.contact', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
            ],
            $seoMeta
        ));
    }


    public function indexPortfolio()
    {
        // Fetch the Portfolio Page (type = 7) with SEO
        $page = Page::where('type', 7)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        // Generate SEO
        $seoMeta = $this->generateSeo(
            $page,
            'Our Portfolio',                                  // default title
            'Explore our completed projects and works',      // default description
            'portfolio, projects, construction, works',     // default keywords
            asset('Website/images/background/image-1.jpg')  // default image
        );

        // Fetch active categories for filters
        $categories = PortfolioCategory::where('status', 1)
            ->whereNull('deleted_at')
            ->orderBy('title')
            ->get();

        // Fetch active portfolios with category and partner
        $portfolios = Portfolio::with('category', 'partner')
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        return view('website.portfolio', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
                'categories' => $categories,
                'portfolios' => $portfolios,
            ],
            $seoMeta
        ));
    }
    public function portfolioSingle($slug)
    {
        $portfolio = Portfolio::with(['category', 'partner', 'seo'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // SEO (use seo relation)
        $seoMeta = $this->generateSeo(
            $portfolio,
            $portfolio->title,
            $portfolio->short_description,
            'portfolio, project',
            $portfolio->banner_image
            ? asset('storage/' . $portfolio->banner_image)
            : asset('Website/images/background/image-1.jpg')
        );

        return view('website.portfolio-single', array_merge(
            [
                'portfolio' => $portfolio,
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
            ],
            $seoMeta
        ));
    }


    public function indexCareer()
    {
        // Page data (type = 9 Career)
        $page = Page::where('type', 9)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        // Careers list
        $careers = \App\Models\Career::where('status', 1)
            ->latest()
            ->get();

        // SEO
        $seoMeta = $this->generateSeo(
            $page,
            'Career Opportunities',
            'Explore our latest career openings and job opportunities.',
            'career, jobs, vacancy',
            asset('Website/images/background/image-1.jpg')
        );

        return view('website.career', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
                'careers' => $careers,
            ],
            $seoMeta
        ));
    }
    public function careerSingle($slug)
    {
        $career = Career::where('slug', $slug)
            ->where('status', 1)
            ->with('seoDetail')
            ->firstOrFail();

        $seoMeta = $this->generateSeo(
            $career,
            $career->job_title,
            $career->short_summery,
            'career, job',
            $career->banner_image
            ? asset('storage/' . $career->banner_image)
            : asset('Website/images/background/image-1.jpg')
        );

        return view('website.career-single', array_merge(
            [
                'career' => $career,
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
            ],
            $seoMeta
        ));
    }


    public function indexService()
    {
        // Fetch the Services Page (type = 3)
        $page = Page::where('type', 3)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,                                   // model
            'Our Services',                           // default title
            'Explore our professional services',     // default description
            'services, IT solutions, business',      // default keywords
            asset('Website/images/background/image-1.jpg') // default image
        );

        $services = Service::where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        // Return view with page, services, and SEO
        return view('website.service', array_merge(
            compact('services', 'page'),
            $seoMeta
        ));
    }


    public function indexGallery()
    {
        // Fetch the Gallery Page (type = 6) with SEO
        $page = Page::where('type', 6)
            ->where('status', 1)
            ->with('seoDetail')
            ->first();

        $seoMeta = $this->generateSeo(
            $page,
            'Gallery',
            'Explore our completed projects and images',
            'gallery, projects, images, construction',
            asset('Website/images/background/image-1.jpg')
        );

        // Fetch galleries with pagination (6 per page)
        $galleries = Gallery::where('status', 1)->latest()->paginate(6);

        return view('website.gallery', array_merge(
            [
                'siteSetting' => $this->siteSetting,
                'pages' => $this->pages,
                'page' => $page,
                'galleries' => $galleries,
            ],
            $seoMeta
        ));
    }


    public function serviceSingle($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Use reusable SEO method
        $seoMeta = $this->generateSeo($service);

        return view('website.service-single', array_merge(
            compact('service'),
            $seoMeta
        ));
    }


    /**
     * Generate SEO meta data for any model
     *
     * @param  mixed $model
     * @param  string $defaultTitle
     * @param  string $defaultDescription
     * @param  string $defaultKeywords
     * @param  string $defaultImage
     * @return array
     */
    protected function generateSeo($model, $defaultTitle = '', $defaultDescription = '', $defaultKeywords = '', $defaultImage = '')
    {
        $seo = $model->seoDetail ?? null;

        // Title fallback
        $title = $seo->seo_title ?? $model->title ?? $defaultTitle ?: 'Website';

        // Description fallback
        $description = $seo->seo_description ?? $model->short_description ?? $defaultDescription ?: 'IT Solutions & Business Services Multipurpose Responsive Website Template';

        // Keywords fallback safely
        $keywords = ($seo && !empty($seo->seo_keywords))
            ? (is_array($seo->seo_keywords) ? implode(',', $seo->seo_keywords) : $seo->seo_keywords)
            : ($defaultKeywords ?: 'IT solutions, Business Services, TechnoxIt, Bootstrap Template');

        // Image fallback
        if ($seo && !empty($seo->seo_image)) {
            $image = asset('storage/' . $seo->seo_image);
        } elseif (!empty($model->banner_image)) {
            $image = asset('storage/' . $model->banner_image);
        } else {
            $image = $defaultImage ?: asset('Website/images/background/image-1.jpg');
        }

        return [
            'meta_title' => $title,
            'meta_description' => $description,
            'meta_keywords' => $keywords,
            'meta_image' => $image,
        ];
    }


}
