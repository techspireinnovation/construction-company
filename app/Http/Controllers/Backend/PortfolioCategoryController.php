<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioCategory\StoreRequest;
use App\Http\Requests\PortfolioCategory\UpdateRequest;
use App\Repositories\Interfaces\PortfolioCategoryRepositoryInterface;
use Illuminate\Http\Request;

class PortfolioCategoryController extends Controller
{
    protected PortfolioCategoryRepositoryInterface $repository;

    public function __construct(PortfolioCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->all();
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio-categories.create');
    }

    public function store(StoreRequest $request)
    {
        $this->repository->store($request->validated());
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('admin.portfolio-categories.edit', compact('category'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->repository->update($request->validated(), $id);
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category updated successfully.');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);
        $ids = array_map('intval', explode(',', $request->ids));
        $this->repository->bulkDestroy($ids);
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Selected categories deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $this->repository->toggleStatus($id);
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Status updated successfully.');
    }
}
