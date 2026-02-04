<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateRequest;
use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected PageRepositoryInterface $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {
        $pages = $this->pageRepository->all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(StoreRequest $request)
    {
        $this->pageRepository->store($request->validated());

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page SEO created successfully');
    }

    public function edit($id)
    {
        $page = $this->pageRepository->find($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->pageRepository->update($request->validated(), $id);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page SEO updated successfully');
    }

    public function toggleStatus($id)
    {
        $this->pageRepository->toggleStatus($id);

        return back()->with('success', 'Status updated successfully');
    }
    public function updateOrder(Request $request)
    {
        $this->pageRepository->updateOrder($request->order);

        return response()->json(['success' => true]);
    }

}
