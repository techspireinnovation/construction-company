<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::paginate(10);
        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'Company_name' => 'nullable|string|max:255',
            'Company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        try {
            \Log::debug('Store validated data:', $validated);
            
            // Handle company logo
            if ($request->hasFile('Company_logo')) {
                $image = Image::make($request->file('Company_logo'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $logoFilename = 'awards/logos/' . uniqid() . '.' . $request->file('Company_logo')->getClientOriginalExtension();
                Storage::disk('public')->put($logoFilename, (string) $image->encode());
                $validated['Company_logo'] = $logoFilename;
            }

            // Handle multiple images
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $img = Image::make($image);
                    $img->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $filename = 'awards/images/' . uniqid() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->put($filename, (string) $img->encode());
                    $imagePaths[] = $filename;
                }
                $validated['images'] = json_encode($imagePaths);
            }

            Award::create($validated);

            return redirect()->route('admin.awards.index')->with('success', 'Award created successfully!');
        } catch (\Exception $e) {
            \Log::error('Award creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create award.');
        }
    }

    public function edit($id)
    {
        $award = Award::findOrFail($id);
        return view('admin.awards.edit', compact('award'));
    }

    public function update(Request $request, $id)
    {
        $award = Award::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'Company_name' => 'nullable|string|max:255',
            'Company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        try {
            \Log::debug('Update validated data:', $validated);
            $validated['status'] = $request->has('status') ? 1 : 0;

            // Handle company logo
            if ($request->hasFile('Company_logo')) {
                if ($award->Company_logo && Storage::disk('public')->exists($award->Company_logo)) {
                    Storage::disk('public')->delete($award->Company_logo);
                }
                $image = Image::make($request->file('Company_logo'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $logoFilename = 'awards/logos/' . uniqid() . '.' . $request->file('Company_logo')->getClientOriginalExtension();
                Storage::disk('public')->put($logoFilename, (string) $image->encode());
                $validated['Company_logo'] = $logoFilename;
            } else {
                $validated['Company_logo'] = $award->Company_logo;
            }

            // Handle multiple images
            $imagePaths = $award->images ? json_decode($award->images, true) : [];
            if ($request->hasFile('images')) {
                // Delete old images
                if ($award->images) {
                    foreach (json_decode($award->images, true) as $oldImage) {
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                }
                // Save new images
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $img = Image::make($image);
                    $img->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $filename = 'awards/images/' . uniqid() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->put($filename, (string) $img->encode());
                    $imagePaths[] = $filename;
                }
                $validated['images'] = json_encode($imagePaths);
            } else {
                $validated['images'] = $award->images;
            }

            $award->update($validated);

            return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Award update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update award.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $award = Award::findOrFail($id);
        $validated = $request->validate([
            'status' => 'nullable|boolean',
        ]);

        try {
            \Log::debug('Toggle status validated data:', $validated);
            $newStatus = $request->has('status') ? 1 : 0;
            $award->update(['status' => $newStatus]);
            return redirect()->route('admin.awards.index')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy($id)
    {
        $award = Award::findOrFail($id);
        try {
            // Delete company logo
            if ($award->Company_logo && Storage::disk('public')->exists($award->Company_logo)) {
                Storage::disk('public')->delete($award->Company_logo);
            }
            // Delete images
            if ($award->images) {
                foreach (json_decode($award->images, true) as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
            $award->delete();

            return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Award deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete award.');
        }
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $awards = Award::whereIn('id', $ids)->get();
            foreach ($awards as $award) {
                if ($award->Company_logo && Storage::disk('public')->exists($award->Company_logo)) {
                    Storage::disk('public')->delete($award->Company_logo);
                }
                if ($award->images) {
                    foreach (json_decode($award->images, true) as $image) {
                        if (Storage::disk('public')->exists($image)) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }
                $award->delete();
            }

            return redirect()->route('admin.awards.index')->with('success', count($ids) . ' award(s) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk award deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete awards.');
        }
    }
}
