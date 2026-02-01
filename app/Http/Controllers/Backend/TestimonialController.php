<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    protected $folderPath = 'testimonials';
    protected $path;
    public function __construct()
    {
        $this->path = storage_path('app/public/' . $this->folderPath);
        if (!file_exists($this->path)) {
            Storage::disk('public')->makeDirectory($this->folderPath);
            if (file_exists($this->path)) {
                chmod($this->path, 0755);
            }
        }
    }

    public function index()
    {
        $testimonials = Testimonial::withTrashed()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'designation', 'company_name', 'message', 'status']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
            Storage::disk('public')->putFileAs($this->folderPath, $image, $imageName);
            $data['image'] = $imageName;
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::withTrashed()->findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $testimonial = Testimonial::withTrashed()->findOrFail($id);
        $data = $request->only(['name', 'designation', 'company_name', 'message', 'status']);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($this->folderPath . '/' . $testimonial->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
            Storage::disk('public')->putFileAs($this->folderPath, $image, $imageName);
            $data['image'] = $imageName;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::withTrashed()->findOrFail($id);
        if ($testimonial->image) {
            Storage::disk('public')->delete($this->folderPath . '/' . $testimonial->image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }

    public function toggle_status(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $status = $request->input('status', 0);
        $testimonial->update(['status' => $status]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Status updated successfully.');
    }

    public function bulk_destroy(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        $testimonials = Testimonial::withTrashed()->whereIn('id', $ids)->get();

        foreach ($testimonials as $testimonial) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($this->folderPath . '/' . $testimonial->image);
            }
            $testimonial->delete();
        }

        return redirect()->route('admin.testimonials.index')->with('success', 'Selected testimonials deleted successfully.');
    }
}