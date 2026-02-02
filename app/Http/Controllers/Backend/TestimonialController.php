<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonial\StoreRequest;
use App\Http\Requests\Testimonial\UpdateRequest;
use App\Repositories\TestimonialRepository;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    protected TestimonialRepository $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->testimonialRepository = $testimonialRepository;
    }

    public function index()
    {
        $testimonials = $this->testimonialRepository->all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(StoreRequest $request)
    {
        $this->testimonialRepository->store($request->validated());

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit($id)
    {
        $testimonial = $this->testimonialRepository->find($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->testimonialRepository->update($request->validated(), $id);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $this->testimonialRepository->delete($id);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);

        $ids = array_map('intval', explode(',', $request->ids));

        $this->testimonialRepository->bulkDestroy($ids);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Selected testimonials deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $this->testimonialRepository->toggleStatus($id);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Status updated successfully.');
    }
}
