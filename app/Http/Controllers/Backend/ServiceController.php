<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    protected ServiceRepositoryInterface $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(StoreRequest $request)
    {
        // Add this for debugging
        \Log::info('Form submitted with data:', $request->all());
        \Log::info('Files:', $request->files->all());

        // REMOVE OR COMMENT THIS LINE - it's preventing execution
        // dd($request->all()); // <-- THIS IS THE PROBLEM

        try {
            $service = $this->serviceRepository->store($request->validated());

            \Log::info('Service created:', $service->toArray());

            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service created successfully');
        } catch (\Exception $e) {
            \Log::error('Service creation failed: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return back()
                ->withInput()
                ->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->serviceRepository->update($request->validated(), $id);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $this->serviceRepository->delete($id);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully');
    }
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = array_map('intval', explode(',', $request->ids));

        $this->serviceRepository->bulkDestroy($ids);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Selected services deleted successfully');
    }

    public function toggleStatus($id)
    {
        $this->serviceRepository->toggleStatus($id);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Status updated successfully');
    }

}