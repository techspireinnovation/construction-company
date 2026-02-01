<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::paginate(10);
        return view('admin.blog_category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog_category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'seo_title' => 'nullable|string|max:255',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        try {
            \Log::debug('Store validated data:', $validated);
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('categories', 'public');
            }
            if ($request->hasFile('seo_image')) {
                $validated['seo_image'] = $request->file('seo_image')->store('categories/seo', 'public');
            }

            BlogCategory::create($validated);

            return redirect()->route('blog_category.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            \Log::error('Category creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create category.');
        }
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
      {
          $category = BlogCategory::findOrFail($id);
          $validated = $request->validate([
              'title' => 'required|string|max:255',
              'description' => 'nullable|string',
              'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
              'status' => 'boolean', // Removed 'required' to allow unchecked
              'seo_title' => 'nullable|string|max:255',
              'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
              'seo_keywords' => 'nullable|string',
              'seo_description' => 'nullable|string',
          ]);

          try {
              \Log::debug('Update validated data:', $validated);
              // Set status to 0 if not present (unchecked)
              $validated['status'] = $request->has('status') ? 1 : 0;

              if ($request->hasFile('image')) {
                  if ($category->image && Storage::disk('public')->exists($category->image)) {
                      Storage::disk('public')->delete($category->image);
                  }
                  $validated['image'] = $request->file('image')->store('categories', 'public');
              }
              if ($request->hasFile('seo_image')) {
                  if ($category->seo_image && Storage::disk('public')->exists($category->seo_image)) {
                      Storage::disk('public')->delete($category->seo_image);
                  }
                  $validated['seo_image'] = $request->file('seo_image')->store('categories/seo', 'public');
              }

              $category->update($validated);

              return redirect()->route('blog_category.index')->with('success', 'Category updated successfully!');
          } catch (\Exception $e) {
              \Log::error('Category update failed: ' . $e->getMessage());
              return back()->withInput()->with('error', 'Failed to update category.');
          }
      }

      public function toggleStatus(Request $request, $id)
      {
          $category = BlogCategory::findOrFail($id);
          $validated = $request->validate([
              'status' => 'boolean', // Removed 'required' to allow unchecked
          ]);

          try {
              \Log::debug('Toggle status validated data:', $validated);
              // Toggle status based on checkbox presence
              $newStatus = $request->has('status') ? 1 : 0;
              $category->update(['status' => $newStatus]);
              return redirect()->route('blog_category.index')->with('success', 'Status updated successfully!');
          } catch (\Exception $e) {
              \Log::error('Status update failed: ' . $e->getMessage());
              return back()->with('error', 'Failed to update status.');
          }
      }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        try {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            if ($category->seo_image && Storage::disk('public')->exists($category->seo_image)) {
                Storage::disk('public')->delete($category->seo_image);
            }
            $category->delete();

            return redirect()->route('blog_category.index')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Category deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete category.');
        }
    }

   

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        try {
            $ids = explode(',', $validated['ids']);
            $categories = BlogCategory::whereIn('id', $ids)->get();
            foreach ($categories as $category) {
                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
                if ($category->seo_image && Storage::disk('public')->exists($category->seo_image)) {
                    Storage::disk('public')->delete($category->seo_image);
                }
                $category->delete();
            }

            return redirect()->route('blog_category.index')->with('success', count($ids) . ' category(ies) deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk category deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete categories.');
        }
    }
}