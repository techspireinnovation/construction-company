<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateRequest;
use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    protected PageRepositoryInterface $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display pages with nested children
     */
    public function index()
    {
        $pages = $this->pageRepository->all();

        $allTypes = range(1, 10);

        $usedTypes = \App\Models\Page::distinct()
            ->pluck('type')
            ->toArray();

        $allTypesAdded = count(array_diff($allTypes, $usedTypes)) === 0;

        return view('admin.pages.index', compact(
            'pages',
            'allTypesAdded'
        ));
    }



    /**
     * Show create page form
     */
    /**
     * Show create page form
     */
    public function create()
    {
        // Get already used page types
        $usedTypes = \App\Models\Page::pluck('type')->toArray();

        return view('admin.pages.create', compact('usedTypes'));
    }


    /**
     * Store new page
     */
    public function store(StoreRequest $request)
    {
        $this->pageRepository->store($request->validated());

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page created successfully');
    }

    /**
     * Show edit page form
     */
    public function edit($id)
    {
        $page = $this->pageRepository->find($id);

        $types = [
            1 => 'Home',
            2 => 'About Us',
            3 => 'Services',
            4 => 'Team',
            5 => 'Testimonial',
            6 => 'Gallery',
            7 => 'Project',
            8 => 'Blog',
            9 => 'Career',
            10 => 'Contact'
        ];

        return view('admin.pages.edit', compact('page', 'types'));
    }


    /**
     * Update page
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->pageRepository->update($request->validated(), $id);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page updated successfully');
    }

    /**
     * Toggle page status
     */
    public function toggleStatus($id)
    {
        $this->pageRepository->toggleStatus($id);

        return back()->with('success', 'Status updated successfully');
    }

    public function updateOrder(Request $request)
    {
        try {
            $request->validate([
                'order' => 'required|string',
            ]);

            // Decode the JSON string
            $orderData = json_decode($request->order, true);

            if (!is_array($orderData)) {
                return back()->with('error', 'Invalid order data format');
            }

            DB::beginTransaction();

            // Pass the array directly
            $this->pageRepository->updateOrder($orderData);

            DB::commit();

            return back()->with('success', 'Page order updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Failed to update order: ' . $e->getMessage());

            return back()->with('error', 'Failed to update order: ' . $e->getMessage());
        }
    }
}
