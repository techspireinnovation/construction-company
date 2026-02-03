<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StoreRequest;
use App\Http\Requests\Portfolio\UpdateRequest;
use App\Models\Partner;
use App\Models\PortfolioCategory;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    protected PortfolioRepositoryInterface $portfolioRepository;

    public function __construct(PortfolioRepositoryInterface $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function index()
    {
        $portfolios = $this->portfolioRepository->all();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = PortfolioCategory::where('status', 1)->get();
        $partners = Partner::where('status', 1)->get();


        return view('admin.portfolios.create', compact('categories', 'partners'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $portfolio = $this->portfolioRepository->store($request->validated());

            return redirect()
                ->route('admin.portfolios.index')
                ->with('success', 'Portfolio created successfully');
        } catch (\Exception $e) {
            \Log::error('Portfolio creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create portfolio');
        }
    }

    public function edit($id)
    {
        $portfolio = $this->portfolioRepository->find($id);
        $categories = PortfolioCategory::where('status', 1)->get();
        $partners = Partner::where('status', 1)->get();

        return view('admin.portfolios.edit', compact('portfolio', 'categories', 'partners'));
    }


    public function update(UpdateRequest $request, $id)
    {
        $this->portfolioRepository->update($request->validated(), $id);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio updated successfully');
    }

    public function destroy($id)
    {
        $this->portfolioRepository->delete($id);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio deleted successfully');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);
        $ids = array_map('intval', explode(',', $request->ids));

        $this->portfolioRepository->bulkDestroy($ids);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Selected portfolios deleted successfully');
    }

    public function toggleStatus($id)
    {
        $this->portfolioRepository->toggleStatus($id);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Status updated successfully');
    }
}
