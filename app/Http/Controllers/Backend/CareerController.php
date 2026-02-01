<?php

namespace App\Http\Controllers\Backend;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    protected $folderPath = 'careers';

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
        $careers = Career::withTrashed()->paginate(10);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'shift_type' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'job_type' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'posted_date' => 'nullable|date',
            'responsibilities' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['title', 'company_name', 'company_location', 'employment_type', 'salary_range', 'shift_type', 'short_description', 'description', 'requirements', 'job_type', 'posted_date', 'responsibilities', 'status']);
        if ($request->hasFile('company_logo')) {
            $logo = $request->file('company_logo');
            $logoName = time() . '_' . rand(1000, 9999) . '.' . $logo->extension();
            Storage::disk('public')->putFileAs($this->folderPath, $logo, $logoName);
            $data['company_logo'] = $logoName;
        }

        Career::create($data);

        return redirect()->route('admin.careers.index')->with('success', 'Career created successfully.');
    }

    public function edit($id)
    {
        $career = Career::withTrashed()->findOrFail($id);
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'shift_type' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'job_type' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'posted_date' => 'nullable|date',
            'responsibilities' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $career = Career::withTrashed()->findOrFail($id);
        $data = $request->only(['title', 'company_name', 'company_location', 'employment_type', 'salary_range', 'shift_type', 'short_description', 'description', 'requirements', 'job_type', 'posted_date', 'responsibilities', 'status']);

        if ($request->hasFile('company_logo')) {
            if ($career->company_logo) {
                Storage::disk('public')->delete($this->folderPath . '/' . $career->company_logo);
            }
            $logo = $request->file('company_logo');
            $logoName = time() . '_' . rand(1000, 9999) . '.' . $logo->extension();
            Storage::disk('public')->putFileAs($this->folderPath, $logo, $logoName);
            $data['company_logo'] = $logoName;
        }

        $career->update($data);

        return redirect()->route('admin.careers.index')->with('success', 'Career updated successfully.');
    }

    public function destroy($id)
    {
        $career = Career::withTrashed()->findOrFail($id);
        if ($career->company_logo) {
            Storage::disk('public')->delete($this->folderPath . '/' . $career->company_logo);
        }
        $career->forceDelete();

        return redirect()->route('admin.careers.index')->with('success', 'Career deleted successfully.');
    }
    public function toggle_status(Request $request, $id)
    {
        $career = Career::findOrFail($id);
        $status = $request->has('status') ? 1 : 0; // Check if 'status' is present in the request
        $career->update(['status' => $status]);

        return redirect()->route('admin.careers.index')->with('success', 'Status updated successfully.');
    }

    public function bulk_destroy(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        $careers = Career::withTrashed()->whereIn('id', $ids)->get();

        foreach ($careers as $career) {
            if ($career->company_logo) {
                Storage::disk('public')->delete($this->folderPath . '/' . $career->company_logo);
            }
            $career->forceDelete();
        }

        return redirect()->route('admin.careers.index')->with('success', 'Selected careers deleted successfully.');
    }
}