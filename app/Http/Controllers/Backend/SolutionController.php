<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::paginate(10);
        return view('admin.solutions.index', compact('solutions'));
    }

    public function create()
    {
        return view('admin.solutions.create');
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
                $filename = 'solutions/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            }

            Solution::create($validated);

            return redirect()->route('admin.solutions.index')->with('success', 'Solution created successfully!');
        } catch (\Exception $e) {
            \Log::error('Solution creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create solution.');
        }
    }

    public function edit($id)
    {
        $solution = Solution::findOrFail($id);
        return view('admin.solutions.edit', compact('solution'));
    }

    public function update(Request $request, $id)
    {
        $solution = Solution::findOrFail($id);
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
                if ($solution->image && Storage::disk('public')->exists($solution->image)) {
                    Storage::disk('public')->delete($solution->image);
                }
                $image = Image::make($request->file('image'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $filename = 'solutions/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            } else {
                $validated['image'] = $solution->image;
            }

            $solution->update($validated);

            return redirect()->route('admin.solutions.index')->with('success', 'Solution updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Solution update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update solution.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $solution = Solution::findOrFail($id);
        $validated = $request->validate([
            'status' => 'nullable|boolean',
        ]);

        try {
            \Log::debug('Toggle status validated data:', $validated);
            $newStatus = $request->has('status') ? 1 : 0;
            $solution->update(['status' => $newStatus]);
            return redirect()->route('admin.solutions.index')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy($id)
    {
        $solution = Solution::findOrFail($id);
        try {
            if ($solution->image && Storage::disk('public')->exists($solution->image)) {
                Storage::disk('public')->delete($solution->image);
            }
            $solution->delete();

            return redirect()->route('admin.solutions.index')->with('success', 'Solution deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Solution deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete solution.');
        }
    }


    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $solutions = Solution::whereIn('id', $ids)->get();
            foreach ($solutions as $solution) {
                if ($solution->image && Storage::disk('public')->exists($solution->image)) {
                    Storage::disk('public')->delete($solution->image);
                }
                $solution->delete();
            }

            return redirect()->route('admin.solutions.index')->with('success', count($ids) . ' solution(s) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk solution deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete solutions.');
        }
    }

}