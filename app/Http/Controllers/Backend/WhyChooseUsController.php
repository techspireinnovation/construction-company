<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhyChooseUs\StoreRequest;
use App\Http\Requests\WhyChooseUs\UpdateRequest;
use App\Repositories\WhyChooseUsRepository;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    protected WhyChooseUsRepository $repository;

    public function __construct(WhyChooseUsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $items = $this->repository->all();
        return view('admin.why_choose_us.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why_choose_us.create');
    }

    public function store(StoreRequest $request)
    {
        $this->repository->store($request->validated());

        return redirect()->route('admin.why_choose_us.index')
            ->with('success', 'Entry created successfully.');
    }

    public function edit($id)
    {
        $item = $this->repository->find($id);
        return view('admin.why_choose_us.edit', compact('item'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->repository->update($request->validated(), $id);

        return redirect()->route('admin.why_choose_us.index')
            ->with('success', 'Entry updated successfully.');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.why_choose_us.index')
            ->with('success', 'Entry deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);
        $ids = array_map('intval', explode(',', $request->ids));

        $this->repository->bulkDestroy($ids);

        return redirect()->route('admin.why_choose_us.index')
            ->with('success', 'Selected entries deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $this->repository->toggleStatus($id);

        return redirect()->route('admin.why_choose_us.index')
            ->with('success', 'Status updated successfully.');
    }
}
