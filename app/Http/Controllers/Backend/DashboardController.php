<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Career;
use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get counts for active, non-deleted records
        $blogCount = Blog::where('status', 1)->whereNull('deleted_at')->count();
        $portfolioCount = Portfolio::where('status', 1)->whereNull('deleted_at')->count();
        $serviceCount = Service::where('status', 1)->whereNull('deleted_at')->count();
        $teamCount = Team::where('status', 1)->whereNull('deleted_at')->count();
        $contactCount = ContactSubmission::count(); // No status/deleted_at for contacts
        $testimonialCount = Testimonial::where('status', 1)->whereNull('deleted_at')->count();
        $galleryCount = Gallery::where('status', 1)->count();
        $careerCount = Career::where('status', 1)->count();
        $blogCategoryCount = BlogCategory::where('status', 1)->whereNull('deleted_at')->count();
        $portfolioCategoryCount = PortfolioCategory::where('status', 1)->whereNull('deleted_at')->count();
        $partnerCount = Partner::where('status', 1)->whereNull('deleted_at')->count();
        $faqCount = Faq::where('status', 1)->whereNull('deleted_at')->count();
        $whyChooseUsCount = WhyChooseUs::where('status', 1)->whereNull('deleted_at')->count();
        $pageCount = Page::where('status', 1)->count();

        // Get recent blogs with category (active, non-deleted)
        $recentBlogs = Blog::with('category')
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->latest()
            ->take(5)
            ->get();

        // Get recent contacts
        $recentContacts = ContactSubmission::latest()->take(6)->get();

        // Calculate percentage changes
        $stats = $this->calculateStats();

        return view('admin.dashboard.index', compact(
            'blogCount',
            'portfolioCount',
            'serviceCount',
            'teamCount',
            'contactCount',
            'testimonialCount',
            'galleryCount',
            'careerCount',
            'blogCategoryCount',
            'portfolioCategoryCount',
            'partnerCount',
            'faqCount',
            'whyChooseUsCount',
            'pageCount',
            'recentBlogs',
            'recentContacts',
            'stats'
        ));
    }

    /**
     * Calculate percentage changes for stats
     */
    private function calculateStats()
    {
        $now = now();
        $lastMonth = $now->copy()->subMonth();

        $models = [
            'blog' => Blog::class,
            'portfolio' => Portfolio::class,
            'service' => Service::class,
            'team' => Team::class,
            'testimonial' => Testimonial::class,
            'gallery' => Gallery::class,
            'contact' => ContactSubmission::class,
            'career' => Career::class,
        ];

        $stats = [];

        foreach ($models as $key => $modelClass) {
            // For ContactSubmission, don't filter by status/deleted_at
            if ($key === 'contact') {
                $recentCount = $modelClass::whereDate('created_at', '>=', $lastMonth)->count();
                $oldCount = $modelClass::whereDate('created_at', '<', $lastMonth)->count();
            }
            // For Career, only filter by status
            elseif ($key === 'career') {
                $recentCount = $modelClass::where('status', 1)->whereDate('created_at', '>=', $lastMonth)->count();
                $oldCount = $modelClass::where('status', 1)->whereDate('created_at', '<', $lastMonth)->count();
            }
            // For Gallery, only filter by status
            elseif ($key === 'gallery') {
                $recentCount = $modelClass::where('status', 1)->whereDate('created_at', '>=', $lastMonth)->count();
                $oldCount = $modelClass::where('status', 1)->whereDate('created_at', '<', $lastMonth)->count();
            }
            // For other models, filter by status and deleted_at
            else {
                $recentCount = $modelClass::where('status', 1)
                    ->whereNull('deleted_at')
                    ->whereDate('created_at', '>=', $lastMonth)
                    ->count();

                $oldCount = $modelClass::where('status', 1)
                    ->whereNull('deleted_at')
                    ->whereDate('created_at', '<', $lastMonth)
                    ->count();
            }

            $change = 0;
            if ($oldCount > 0) {
                $change = (($recentCount - $oldCount) / $oldCount) * 100;
            } elseif ($recentCount > 0) {
                $change = 100; // All are new this month
            }

            $stats[$key] = [
                'recent' => $recentCount,
                'old' => $oldCount,
                'change' => $change
            ];
        }

        return $stats;
    }

    public function indexProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('admin.profile.index', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'User not authenticated');
        }

        return view('admin.profile.edit', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'old_password' => 'nullable|required_with:password',
            'profile_image' => 'nullable|image|max:5120',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        /*
        |--------------------------------------------------------------------------
        | Password Update
        |--------------------------------------------------------------------------
        */
        if ($request->filled('password')) {

            if (!\Hash::check($request->old_password, $user->password)) {
                return back()->withErrors([
                    'old_password' => 'Old password is incorrect.'
                ]);
            }

            $data['password'] = bcrypt($request->password);
        }

        /*
        |--------------------------------------------------------------------------
        | Profile Image Upload via ImageService
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('profile_image')) {

            $data['profile_image'] = $this->imageService->replace(
                $user->profile_image,
                $request->file('profile_image'),
                'profile'
            );
        }

        $user->update($data);

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Profile updated successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
