<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Career\StoreRequest;
use App\Http\Requests\Career\UpdateRequest;
use App\Models\Career;
use App\Repositories\Interfaces\CareerRepositoryInterface;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    protected CareerRepositoryInterface $careerRepository;

    public function __construct(CareerRepositoryInterface $careerRepository)
    {
        $this->careerRepository = $careerRepository;
    }

    public function index()
    {
        $careers = $this->careerRepository->all();
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }
    public function store(StoreRequest $request)
    {
        \Log::info('Store method called');
        \Log::info('Request data:', $request->all());

        try {
            $this->careerRepository->store($request->validated());

            \Log::info('Career created successfully');
            return redirect()->route('admin.careers.index')
                ->with('success', 'Career created successfully.');

        } catch (\Exception $e) {
            \Log::error('Error creating career: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());

            // Check if there are validation errors
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                \Log::info('Validation errors:', $e->errors());
            }

            return back()
                ->withInput()
                ->with('error', 'Failed to create career. Please try again.');
        }
    }

    // In your controller's edit method
    public function edit($id)
    {
        $career = $this->careerRepository->find($id);

        return view('admin.careers.edit', compact('career'));
    }


    public function update(UpdateRequest $request, $id)
    {
        $this->careerRepository->update($request->validated(), $id);
        return redirect()->route('admin.careers.index')->with('success', 'Career updated successfully');
    }

    public function destroy($id)
    {
        $this->careerRepository->delete($id);
        return redirect()->route('admin.careers.index')->with('success', 'Career deleted successfully');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);
        $ids = array_map('intval', explode(',', $request->ids));
        $this->careerRepository->bulkDestroy($ids);
        return redirect()->route('admin.careers.index')->with('success', 'Selected careers deleted successfully');
    }

    public function toggleStatus($id)
    {
        $this->careerRepository->toggleStatus($id);
        return redirect()->route('admin.careers.index')->with('success', 'Status updated successfully');
    }
}
