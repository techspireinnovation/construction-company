<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\StoreRequest;
use App\Http\Requests\Gallery\UpdateRequest;
use App\Repositories\GalleryRepository;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected GalleryRepository $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function index()
    {
        $galleries = $this->galleryRepository->all();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(StoreRequest $request)
    {
        $this->galleryRepository->store($request->validated());

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery created successfully.');
    }

    public function edit($id)
    {
        $gallery = $this->galleryRepository->find($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->galleryRepository->update($request->validated(), $id);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery updated successfully.');
    }

    public function destroy($id)
    {
        $this->galleryRepository->delete($id);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);

        $ids = array_map('intval', explode(',', $request->ids));

        $this->galleryRepository->bulkDestroy($ids);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Selected galleries deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $this->galleryRepository->toggleStatus($id);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Status updated successfully.');
    }
}
