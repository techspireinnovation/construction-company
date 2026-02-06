<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $blogs = $this->blogRepository->all();
        return view('admin.blogs.index', compact('blogs'));
    }


    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        $this->blogRepository->store($request->validated());
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit($id)
    {
        $blog = $this->blogRepository->find($id);
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }


    public function update(UpdateRequest $request, $id)
    {
        $this->blogRepository->update($request->validated(), $id);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        $this->blogRepository->delete($id);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);
        $ids = array_map('intval', explode(',', $request->ids));
        $this->blogRepository->bulkDestroy($ids);
        return redirect()->route('admin.blogs.index')->with('success', 'Selected blogs deleted successfully');
    }

    public function toggleStatus($id)
    {
        $this->blogRepository->toggleStatus($id);
        return redirect()->route('admin.blogs.index')->with('success', 'Status updated successfully');
    }
}
