<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\StoreRequest;
use App\Http\Requests\Partner\UpdateRequest;
use App\Repositories\Interfaces\PartnerRepositoryInterface;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    protected PartnerRepositoryInterface $partnerRepository;

    public function __construct(PartnerRepositoryInterface $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function index()
    {
        $partners = $this->partnerRepository->all();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(StoreRequest $request)
    {
        $this->partnerRepository->store($request->validated());

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner created successfully.');
    }

    public function edit($id)
    {
        $partner = $this->partnerRepository->find($id);
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->partnerRepository->update($request->validated(), $id);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner updated successfully.');
    }

    public function destroy($id)
    {
        $this->partnerRepository->delete($id);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);

        $ids = array_map('intval', explode(',', $request->ids));

        $this->partnerRepository->bulkDestroy($ids);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Selected partners deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $this->partnerRepository->toggleStatus($id);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Status updated successfully.');
    }
}
