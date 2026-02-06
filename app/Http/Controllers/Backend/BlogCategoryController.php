<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategory\StoreRequest;
use App\Http\Requests\BlogCategory\UpdateRequest;
use App\Repositories\Interfaces\BlogCategoryRepositoryInterface;

class BlogCategoryController extends Controller
{
    protected BlogCategoryRepositoryInterface $blogCategoryRepository;

    public function __construct(BlogCategoryRepositoryInterface $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    public function index()
    {
        $categories = $this->blogCategoryRepository->all();
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog_categories.create');
    }

    public function store(StoreRequest $request)
    {
        $this->blogCategoryRepository->store($request->validated());

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('success', 'Blog category created successfully');
    }

    public function edit($id)
    {
        $category = $this->blogCategoryRepository->find($id);
        return view('admin.blog_categories.edit', compact('category'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->blogCategoryRepository->update($request->validated(), $id);

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('success', 'Blog category updated successfully');
    }

    public function destroy($id)
    {
        $this->blogCategoryRepository->delete($id);

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('success', 'Blog category deleted successfully');
    }

    public function toggleStatus($id)
    {
        $this->blogCategoryRepository->toggleStatus($id);

        return back()->with('success', 'Status updated successfully');
    }
}
