<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ExpertiseController extends Controller
{
    public function index()
    {
        $expertises = Expertise::paginate(10);
        return view('admin.expertises.index', compact('expertises'));
    }

    public function create()
    {
        return view('admin.expertises.create');
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
                $filename = 'expertises/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            }

            Expertise::create($validated);

            return redirect()->route('admin.expertises.index')->with('success', 'Expertise created successfully!');
        } catch (\Exception $e) {
            \Log::error('Expertise creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create expertise.');
        }
    }

    public function edit($id)
    {
        $expertise = Expertise::findOrFail($id);
        return view('admin.expertises.edit', compact('expertise'));
    }

    public function update(Request $request, $id)
    {
        $expertise = Expertise::findOrFail($id);
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
                if ($expertise->image && Storage::disk('public')->exists($expertise->image)) {
                    Storage::disk('public')->delete($expertise->image);
                }
                $image = Image::make($request->file('image'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $filename = 'expertises/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            } else {
                $validated['image'] = $expertise->image;
            }

            $expertise->update($validated);

            return redirect()->route('admin.expertises.index')->with('success', 'Expertise updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Expertise update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update expertise.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $expertise = Expertise::findOrFail($id);
        $validated = $request->validate([
            'status' => 'nullable|boolean',
        ]);

        try {
            \Log::debug('Toggle status validated data:', $validated);
            $newStatus = $request->has('status') ? 1 : 0;
            $expertise->update(['status' => $newStatus]);
            return redirect()->route('admin.expertises.index')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy($id)
    {
        $expertise = Expertise::findOrFail($id);
        try {
            if ($expertise->image && Storage::disk('public')->exists($expertise->image)) {
                Storage::disk('public')->delete($expertise->image);
            }
            $expertise->delete();

            return redirect()->route('admin.expertises.index')->with('success', 'Expertise deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Expertise deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete expertise.');
        }
    }


    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $expertises = Expertise::whereIn('id', $ids)->get();
            foreach ($expertises as $expertise) {
                if ($expertise->image && Storage::disk('public')->exists($expertise->image)) {
                    Storage::disk('public')->delete($expertise->image);
                }
                $expertise->delete();
            }

            return redirect()->route('admin.expertises.index')->with('success', count($ids) . ' expertise(s) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk expertise deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete expertises.');
        }
    }

}