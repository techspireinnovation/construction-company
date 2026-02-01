<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Partner::query();

        // Handle search
        if ($search = $request->query('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $partners = $query->paginate(10);

        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
                Log::debug('Store validated data:', $validated);
                $data = $validated;
    
                // Handle image upload
                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image')->store('partners', 'public');
                }
    
                Partner::create($data);

            return redirect()->route('admin.partners.index')->with('success', 'Partners created successfully!');
        } catch (\Exception $e) {
            \Log::error('Partners creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create category.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        try {
            Log::debug('Update validated data:', $validated);
            $data = $validated;
            $data['status'] = $request->has('status') ? 1 : 0;

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                    Storage::disk('public')->delete($partner->image);
                }
                $data['image'] = $request->file('image')->store('partners', 'public');
            }

            $partner->update($data);

            return response()->json(['success' => true, 'message' => 'Partner updated successfully']);
        } catch (\Exception $e) {
            Log::error('Partner update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to update partner.'], 500);
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $validated = $request->validate([
            'status' => 'boolean',
        ]);

        try {
            Log::debug('Toggle status validated data:', $validated);
            $newStatus = $request->has('status') ? 1 : 0;
            $partner->update(['status' => $newStatus]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            Log::error('Status update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to update status.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        try {
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }
            $partner->delete();

            return response()->json(['success' => true, 'message' => 'Partner deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Partner deletion failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete partner.'], 500);
        }
    }

    /**
     * Remove multiple resources from storage (soft delete).
     */
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

            return response()->json(['success' => true, 'message' => count($ids) . ' partner(s) deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Bulk partner deletion failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete partners.'], 500);
        }
    }
}