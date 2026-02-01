<?php

namespace App\Http\Controllers\Backend;

use App\Models\WhyChooseUs;
use App\Models\WhyChooseUsContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WhyChooseUsController extends Controller
{
    protected $folderPath = 'why_choose_us';
    protected $iconFolderPath = 'why_choose_us/icons';
    protected $path;
    protected $iconPath;

    public function __construct()
    {
        $this->path = storage_path('app/public/' . $this->folderPath);
        $this->iconPath = storage_path('app/public/' . $this->iconFolderPath);

        foreach ([$this->path, $this->iconPath] as $path) {
            if (!file_exists($path)) {
                Storage::disk('public')->makeDirectory(str_replace(storage_path('app/public/'), '', $path));
                if (file_exists($path)) {
                    chmod($path, 0755);
                }
            }
        }
    }

    public function index()
    {
        return view('admin.why_choose_us.index');
    }

    public function create()
    {
        return view('admin.why_choose_us.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content_title' => 'required|array|min:1',
            'content_title.*' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Could not create')->withInput()->withErrors($validator);
        }

        \DB::beginTransaction();
        try {
            // Store single image
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
                Storage::disk('public')->putFileAs($this->folderPath, $image, $imageName);
            }

            // Store icon
            $iconName = null;
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $iconName = time() . '_' . rand(1000, 9999) . '.' . $icon->extension();
                Storage::disk('public')->putFileAs($this->iconFolderPath, $icon, $iconName);
            }

            $whyChooseUs = WhyChooseUs::create([
                'title' => $request->title,
                'image' => $imageName,
                'icon' => $iconName,
                'status' => $request->has('status') ? 1 : 0,
            ]);

            foreach ($request->content_title as $title) {
                WhyChooseUsContent::create([
                    'choose_us_id' => $whyChooseUs->id,
                    'title' => $title,
                ]);
            }

            \DB::commit();
            return redirect()->route('admin.why_choose_us.index')->with('success', 'Successfully Created!');
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function search(Request $request)
    {
        try {
            $draw = intval($request->input('draw', 1));
            $start = intval($request->input('start', 0));
            $length = intval($request->input('length', env('PAGINATION', 15)));
            $keyword = $request->input('keyword', '');

            if ($length < 1) {
                $length = 15;
            }

            $page = floor($start / $length) + 1;

            $query = WhyChooseUs::query();
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', '%' . $keyword . '%');
            }

            $totalRecords = $query->count();
            $result = $query->orderBy('created_at', 'desc')
                ->skip($start)
                ->take($length)
                ->get();

            $data_arr = [];
            $sn = $start + 1;
            foreach ($result as $record) {
                $action = '<div class="td-flex">' .
                    '<a href="' . route('admin.why_choose_us.edit', $record->id) . '"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>' .
                    ' ' .
                    '<button type="button" class="btn btn-danger delete-btn" data-id="' . $record->id . '" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>' .
                    '</div>';

                $data_arr[] = [
                    'sn' => $sn,
                    'id' => $record->id,
                    'title' => $record->title ?? 'N/A',
                    'status' => $record->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-warning">Inactive</span>',
                    'action' => $action,
                ];
                $sn++;
            }

            return response()->json([
                'draw' => intval($draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $data_arr,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('DataTables WhyChooseUs search error: ' . $e->getMessage());
            return response()->json([
                'draw' => intval($draw),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $whyChooseUs = WhyChooseUs::with('contents')->findOrFail($id);
        return view('admin.why_choose_us.edit', compact('whyChooseUs'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content_title' => 'required|array|min:1',
            'content_title.*' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Could not update')->withInput()->withErrors($validator);
        }

        \DB::beginTransaction();
        try {
            $whyChooseUs = WhyChooseUs::findOrFail($id);
            $imageName = $whyChooseUs->image;
            $iconName = $whyChooseUs->icon;

            if ($request->hasFile('image')) {
                if ($imageName) {
                    Storage::disk('public')->delete($this->folderPath . '/' . $imageName);
                }
                $image = $request->file('image');
                $imageName = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
                Storage::disk('public')->putFileAs($this->folderPath, $image, $imageName);
            }

            if ($request->hasFile('icon')) {
                if ($iconName) {
                    Storage::disk('public')->delete($this->iconFolderPath . '/' . $iconName);
                }
                $icon = $request->file('icon');
                $iconName = time() . '_' . rand(1000, 9999) . '.' . $icon->extension();
                Storage::disk('public')->putFileAs($this->iconFolderPath, $icon, $iconName);
            }

            $whyChooseUs->update([
                'title' => $request->title,
                'image' => $imageName,
                'icon' => $iconName,
                'status' => $request->has('status') ? 1 : 0,
            ]);

            WhyChooseUsContent::where('choose_us_id', $whyChooseUs->id)->delete();
            foreach ($request->content_title as $title) {
                WhyChooseUsContent::create([
                    'choose_us_id' => $whyChooseUs->id,
                    'title' => $title,
                ]);
            }

            \DB::commit();
            return redirect()->route('admin.why_choose_us.index')->with('success', 'Successfully Updated!');
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $whyChooseUs = WhyChooseUs::findOrFail($id);
            if ($whyChooseUs->image) {
                Storage::disk('public')->delete($this->folderPath . '/' . $whyChooseUs->image);
            }
            if ($whyChooseUs->icon) {
                Storage::disk('public')->delete($this->iconFolderPath . '/' . $whyChooseUs->icon);
            }
            $whyChooseUs->delete();
            return redirect()->route('admin.why_choose_us.index')->with('success', 'Successfully Deleted!');
        } catch (\Exception $e) {
            return redirect()->route('admin.why_choose_us.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}