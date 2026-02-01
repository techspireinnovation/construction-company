<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::paginate(10);
        return view('admin.operations.index', compact('operations'));
    }

    public function create()
    {
        return view('admin.operations.create');
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
                $filename = 'operations/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            }

            Operation::create($validated);

            return redirect()->route('admin.operations.index')->with('success', 'Operation created successfully!');
        } catch (\Exception $e) {
            \Log::error('Operation creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create operation.');
        }
    }

    public function edit($id)
    {
        $operation = Operation::findOrFail($id);
        return view('admin.operations.edit', compact('operation'));
    }

    public function update(Request $request, $id)
    {
        $operation = Operation::findOrFail($id);
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
                if ($operation->image && Storage::disk('public')->exists($operation->image)) {
                    Storage::disk('public')->delete($operation->image);
                }
                $image = Image::make($request->file('image'));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $filename = 'operations/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->put($filename, (string) $image->encode());
                $validated['image'] = $filename;
            } else {
                $validated['image'] = $operation->image;
            }

            $operation->update($validated);

            return redirect()->route('admin.operations.index')->with('success', 'Operation updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Operation update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update operation.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $operation = Operation::findOrFail($id);
        $validated = $request->validate([
            'status' => 'nullable|boolean',
        ]);

        try {
            \Log::debug('Toggle status validated data:', $validated);
            $newStatus = $request->has('status') ? 1 : 0;
            $operation->update(['status' => $newStatus]);
            return redirect()->route('admin.operations.index')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function destroy($id)
    {
        $operation = Operation::findOrFail($id);
        try {
            if ($operation->image && Storage::disk('public')->exists($operation->image)) {
                Storage::disk('public')->delete($operation->image);
            }
            $operation->delete();

            return redirect()->route('admin.operations.index')->with('success', 'Operation deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Operation deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete operation.');
        }
    }


    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $operations = Operation::whereIn('id', $ids)->get();
            foreach ($operations as $operation) {
                if ($operation->image && Storage::disk('public')->exists($operation->image)) {
                    Storage::disk('public')->delete($operation->image);
                }
                $operation->delete();
            }

            return redirect()->route('admin.operations.index')->with('success', count($ids) . ' operation(s) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk operation deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete operations.');
        }
    }

}