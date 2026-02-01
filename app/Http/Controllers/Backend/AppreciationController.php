<?php

namespace App\Http\Controllers\Backend;

use App\Models\Appreciation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AppreciationController extends Controller
{
    protected $folderPath = 'appreciations';
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
        $appreciations = Appreciation::withTrashed()->paginate(10);
        return view('admin.appreciations.index', compact('appreciations'));
    }

    public function create()
    {
        return view('admin.appreciations.create');
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

        Appreciation::create($data);

        return redirect()->route('admin.appreciations.index')->with('success', 'Appreciation created successfully.');
    }

    public function edit($id)
    {
        $appreciation = Appreciation::withTrashed()->findOrFail($id);
        return view('admin.appreciations.edit', compact('appreciation'));
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

        $appreciation = Appreciation::withTrashed()->findOrFail($id);
        $data = $request->only(['name', 'designation', 'company_name', 'message', 'status']);

        if ($request->hasFile('image')) {
            if ($appreciation->image) {
                Storage::disk('public')->delete($this->folderPath . '/' . $appreciation->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
            Storage::disk('public')->putFileAs($this->folderPath, $image, $imageName);
            $data['image'] = $imageName;
        }

        $appreciation->update($data);

        return redirect()->route('admin.appreciations.index')->with('success', 'Appreciation updated successfully.');
    }

    public function destroy($id)
    {
        $appreciation = Appreciation::withTrashed()->findOrFail($id);
        if ($appreciation->image) {
            Storage::disk('public')->delete($this->folderPath . '/' . $appreciation->image);
        }
        $appreciation->delete();

        return redirect()->route('admin.appreciations.index')->with('success', 'Appreciation deleted successfully.');
    }

    public function toggle_status(Request $request, $id)
    {
        $appreciation = Appreciation::findOrFail($id);
        $status = $request->input('status', 0);
        $appreciation->update(['status' => $status]);

        return redirect()->route('admin.appreciations.index')->with('success', 'Status updated successfully.');
    }

    public function bulk_destroy(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        $appreciations = Appreciation::withTrashed()->whereIn('id', $ids)->get();

        foreach ($appreciations as $appreciation) {
            if ($appreciation->image) {
                Storage::disk('public')->delete($this->folderPath . '/' . $appreciation->image);
            }
            $appreciation->delete();
        }

        return redirect()->route('admin.appreciations.index')->with('success', 'Selected appreciations deleted successfully.');
    }
}