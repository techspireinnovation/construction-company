<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = Benefit::paginate(10);
        return view('admin.benefits.index', compact('benefits'));
    }

    public function create()
    {
        return view('admin.benefits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        try {
            \Log::debug('Store validated data:', $validated);
            if ($request->hasFile('image')) {
                $image = Image::make($request->file('image'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $filename = 'benefits/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            }

            Benefit::create($validated);

            return redirect()->route('admin.benefits.index')->with('success', 'Benefit created successfully!');
        } catch (\Exception $e) {
            \Log::error('Benefit creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create benefit.');
        }
    }

    public function edit($id)
    {
        $benefit = Benefit::findOrFail($id);
        return view('admin.benefits.edit', compact('benefit'));
    }

    public function update(Request $request, $id)
    {
        $benefit = Benefit::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        try {
            \Log::debug('Update validated data:', $validated);
            $validated['status'] = $request->has('status') ? 1 : 0;

            if ($request->hasFile('image')) {
                if ($benefit->image && Storage::disk('public')->exists($benefit->image)) {
                    Storage::disk('public')->delete($benefit->image);
                }
                $image = Image::make($request->file('image'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $filename = 'benefits/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            } else {
                $validated['image'] = $benefit->image;
            }

            $benefit->update($validated);

            return redirect()->route('admin.benefits.index')->with('success', 'Benefit updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Benefit update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update benefit.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $benefit = Benefit::findOrFail($id);
        $validated = $request->validate([
            'status' => 'nullable|boolean',
        ]);

        try {
            \Log::debug('Toggle status validated data:', $validated);
            $newStatus = $request->has('status') ? 1 : 0;
            $benefit->update(['status' => $newStatus]);
            return redirect()->route('admin.benefits.index')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy($id)
    {
        $benefit = Benefit::findOrFail($id);
        try {
            if ($benefit->image && Storage::disk('public')->exists($benefit->image)) {
                Storage::disk('public')->delete($benefit->image);
            }
            $benefit->delete();

            return redirect()->route('admin.benefits.index')->with('success', 'Benefit deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Benefit deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete benefit.');
        }
    }


    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $benefits = Benefit::whereIn('id', $ids)->get();
            foreach ($benefits as $benefit) {
                if ($benefit->image && Storage::disk('public')->exists($benefit->image)) {
                    Storage::disk('public')->delete($benefit->image);
                }
                $benefit->delete();
            }

            return redirect()->route('admin.benefits.index')->with('success', count($ids) . ' benefit(s) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk benefit deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete benefits.');
        }
    }

}