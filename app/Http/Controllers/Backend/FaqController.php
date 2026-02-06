<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\StoreRequest;
use App\Http\Requests\Faq\UpdateRequest;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected FaqRepository $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index()
    {
        $faqs = $this->faqRepository->all();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(StoreRequest $request)
    {
        $this->faqRepository->store($request->validated());

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit($id)
    {
        $faq = $this->faqRepository->find($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->faqRepository->update($request->validated(), $id);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $this->faqRepository->delete($id);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);

        $ids = array_map('intval', explode(',', $request->ids));

        $this->faqRepository->bulkDestroy($ids);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'Selected FAQs deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $this->faqRepository->toggleStatus($id);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'Status updated successfully.');
    }
}
