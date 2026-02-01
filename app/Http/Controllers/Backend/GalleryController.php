<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        try {
            \Log::debug('Store validated data:', $validated);
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $image = Image::make($imageFile);
                    // Resize image to max width of 800px, maintaining aspect ratio
                    $image->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    // Generate unique filename
                    $filename = 'gallery/' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                    // Save resized image
                    Storage::disk('public')->put($filename, (string) $image->encode());
                    $imagePaths[] = $filename;
                }
                $validated['images'] = json_encode($imagePaths);
            } else {
                $validated['images'] = null;
            }

            Gallery::create($validated);

            return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created successfully!');
        } catch (\Exception $e) {
            \Log::error('Gallery creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create gallery item.');
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images.*' => 'nullable|string', // Validate delete_images
            'status' => 'boolean',
        ]);

        try {
            \Log::debug('Update validated data:', $validated);
            $validated['status'] = $request->has('status') ? 1 : 0;

            // Start with existing images
            $imagePaths = $gallery->images ? json_decode($gallery->images, true) : [];

            // Remove selected images
            if ($request->has('delete_images')) {
                foreach ($request->input('delete_images', []) as $deleteImage) {
                    if (in_array($deleteImage, $imagePaths) && Storage::disk('public')->exists($deleteImage)) {
                        Storage::disk('public')->delete($deleteImage);
                        $imagePaths = array_diff($imagePaths, [$deleteImage]);
                    }
                }
                $imagePaths = array_values($imagePaths); // Reindex array
            }

            // Append new images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $image = Image::make($imageFile);
                    $image->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $filename = 'gallery/' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                    Storage::disk('public')->put($filename, (string) $image->encode());
                    $imagePaths[] = $filename;
                }
            }

            // Update images field (null if empty)
            $validated['images'] = !empty($imagePaths) ? json_encode($imagePaths) : null;

            $gallery->update($validated);

            return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Gallery update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update gallery item.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $validated = $request->validate([
            'status' => 'nullable|boolean',
        ]);

        try {
            \Log::debug('Toggle status validated data:', $validated);
            $newStatus = $request->has('status') ? 1 : 0;
            $gallery->update(['status' => $newStatus]);
            return redirect()->route('admin.gallery.index')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        try {
            if ($gallery->images) {
                foreach (json_decode($gallery->images, true) as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
            $gallery->delete();

            return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Gallery deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete gallery item.');
        }
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $galleries = Gallery::whereIn('id', $ids)->get();
            foreach ($galleries as $gallery) {
                if ($gallery->images) {
                    foreach (json_decode($gallery->images, true) as $image) {
                        if (Storage::disk('public')->exists($image)) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }
                $gallery->delete();
            }

            return redirect()->route('admin.gallery.index')->with('success', count($ids) . ' gallery item(s) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk gallery deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete gallery items.');
        }
    }

    public function search(Request $request)
    {
        $search = $request->query('search');
        $galleries = Gallery::where('title', 'like', "%{$search}%")
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.gallery.index', compact('galleries'));
    }
}
