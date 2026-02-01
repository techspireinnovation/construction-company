<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        try {
            \Log::debug('Store validated data:', $validated);
            if ($request->hasFile('image')) {
                $image = Image::make($request->file('image'));
                // Resize image to max width of 800px, maintaining aspect ratio
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                // Generate unique filename
                $filename = 'partners/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                // Save resized image to storage
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            }

            Partner::create($validated);

            return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully!');
        } catch (\Exception $e) {
            \Log::error('Partner creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create partner.');
        }
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        try {
            \Log::debug('Update validated data:', $validated);
            // Set status to 0 if not present (unchecked)
            $validated['status'] = $request->has('status') ? 1 : 0;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                    Storage::disk('public')->delete($partner->image);
                }
                // Resize new image
                $image = Image::make($request->file('image'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                // Generate unique filename
                $filename = 'partners/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                // Save resized image
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            } else {
                // Preserve existing image if no new image is uploaded
                $validated['image'] = $partner->image;
            }

            $partner->update($validated);

            return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Partner update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update partner.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $validated = $request->validate([
            'status' => 'nullable|boolean',
        ]);

        try {
            \Log::debug('Toggle status validated data:', $validated);
            // Set status based on checkbox presence
            $newStatus = $request->has('status') ? 1 : 0;
            $partner->update(['status' => $newStatus]);
            return redirect()->route('admin.partners.index')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        try {
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }
            $partner->delete();

            return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Partner deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete partner.');
        }
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $partners = Partner::whereIn('id', $ids)->get();
            foreach ($partners as $partner) {
                if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                    Storage::disk('public')->delete($partner->image);
                }
                $partner->delete();
            }

            return redirect()->route('admin.partners.index')->with('success', count($ids) . ' partner(s) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk partner deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete partners.');
        }
    }
}