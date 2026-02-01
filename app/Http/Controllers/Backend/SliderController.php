<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    protected $folderPath = 'sliders';
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
        $sliders = Slider::latest()->paginate(env('PAGINATION', 15));
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        \Log::info('Store request data: ' . json_encode($request->all()));
        \Log::info('Uploaded files: ' . json_encode($request->file('feature_images')));

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'button_name' => 'nullable|string|max:100',
            'button_link' => 'nullable|url|max:255',
            'feature_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:9216',
            'order_no' => 'nullable|integer|min:0',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation errors: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->with('error', 'Could not create: ' . implode(', ', $validator->errors()->all()))->withInput()->withErrors($validator);
        }

        $featureImages = [];
        if ($request->hasFile('feature_images')) {
            foreach ($request->file('feature_images') as $image) {
                if (!$image->isValid()) {
                    \Log::error('Invalid file upload: ' . $image->getClientOriginalName());
                    return redirect()->back()->with('error', 'Invalid file: ' . $image->getClientOriginalName());
                }
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                try {
                    Storage::disk('public')->putFileAs($this->folderPath, $image, $imageName);
                    $featureImages[] = $imageName;
                } catch (\Exception $e) {
                    \Log::error('File storage error: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Could not store image: ' . $e->getMessage());
                }
            }
        }

        \Log::info('Feature images to save: ' . json_encode($featureImages));

        try {
            // Check if this is the first slider
            $isFirstSlider = Slider::count() === 0;

            // If the request sets status to active or it's the first slider, deactivate others
            if ($request->has('status') && $request->status == 'on' || $isFirstSlider) {
                Slider::where('status', 1)->update(['status' => 0]);
            }

            Slider::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'content' => $request->content,
                'button_name' => $request->button_name,
                'button_link' => $request->button_link,
                'feature_image' => json_encode($featureImages),
                'order_no' => $request->order_no,
                'status' => $isFirstSlider ? 1 : ($request->has('status') && $request->status == 'on' ? 1 : 0),
            ]);
        } catch (\Exception $e) {
            \Log::error('Database error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Could not create slider: ' . $e->getMessage());
        }

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'button_name' => 'nullable|string|max:100',
            'button_link' => 'nullable|url|max:255',
            'feature_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:9216',
            'order_no' => 'nullable|integer|min:0',
            'status' => 'boolean',
            'existing_images' => 'nullable|array',
            'removed_images' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Could not update')->withInput()->withErrors($validator);
        }

        $slider = Slider::findOrFail($id);

        // If status is being set to active, deactivate all other sliders
        if ($request->has('status') && $request->status == 'on') {
            Slider::where('status', 1)->update(['status' => 0]);
        }

        $featureImages = json_decode($slider->feature_image, true) ?? [];

        if ($request->has('removed_images')) {
            foreach ($request->removed_images as $removedImage) {
                if (in_array($removedImage, $featureImages)) {
                    Storage::disk('public')->delete($this->folderPath . '/' . $removedImage);
                    $featureImages = array_diff($featureImages, [$removedImage]);
                }
            }
            $featureImages = array_values($featureImages);
        }

        if ($request->hasFile('feature_images')) {
            foreach ($request->file('feature_images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                Storage::disk('public')->putFileAs($this->folderPath, $image, $imageName);
                $featureImages[] = $imageName;
            }
        }

        $slider->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'content' => $request->content,
            'button_name' => $request->button_name,
            'button_link' => $request->button_link,
            'feature_image' => json_encode($featureImages),
            'order_no' => $request->order_no,
            'status' => $request->has('status') && $request->status == 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        try {
            $slider = Slider::findOrFail($id);
            if ($slider->feature_image) {
                foreach (json_decode($slider->feature_image, true) ?? [] as $image) {
                    Storage::disk('public')->delete($this->folderPath . '/' . $image);
                }
            }
            $slider->delete();

            // If the deleted slider was active, activate the first remaining slider
            if ($slider->status == 1 && Slider::count() > 0) {
                Slider::first()->update(['status' => 1]);
            }

            return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.sliders.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.sliders.index')->with('error', 'No sliders selected for deletion.');
        }

        try {
            $ids = explode(',', $request->ids);
            $wasActiveDeleted = false;
            $sliders = Slider::whereIn('id', $ids)->get();
            foreach ($sliders as $slider) {
                if ($slider->status == 1) {
                    $wasActiveDeleted = true;
                }
                if ($slider->feature_image) {
                    foreach (json_decode($slider->feature_image, true) ?? [] as $image) {
                        Storage::disk('public')->delete($this->folderPath . '/' . $image);
                    }
                }
                $slider->delete();
            }

            // If an active slider was deleted, activate the first remaining slider
            if ($wasActiveDeleted && Slider::count() > 0) {
                Slider::first()->update(['status' => 1]);
            }

            return redirect()->route('admin.sliders.index')->with('success', 'Selected sliders deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.sliders.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.sliders.index')->with('error', 'Invalid status value.');
        }

        try {
            $slider = Slider::findOrFail($id);

            // If setting to active, deactivate all other sliders
            if ($request->status == 1) {
                Slider::where('status', 1)->update(['status' => 0]);
            }

            $slider->status = $request->status;
            $slider->save();

            return redirect()->route('admin.sliders.index')->with('success', 'Slider status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.sliders.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $draw = intval($request->get('draw'));
            $start = intval($request->get('start'));
            $paginate = intval($request->get('length', env('PAGINATION', 15)));
            $page = intval(($start / $paginate) + 1);
            $request->merge(['page' => $page]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column'];
            $columnName = $columnName_arr[$columnIndex]['data'];
            $columnSortOrder = $order_arr[0]['dir'];
            $keyword = $request->keyword;

            $result = Slider::query();
            if ($keyword) {
                $result->where('title', 'LIKE', '%' . $keyword . '%');
            }
            $result = $result->latest()->paginate($paginate);

            $data_arr = [];
            $sn = $start + 1;
            foreach ($result as $slider) {
                $data_arr[] = [
                    'sn' => $sn,
                    'id' => $slider->id,
                    'title' => $slider->title ?? 'N/A',
                    'status' => $slider->status,
                    'action' => '',
                ];
                $sn++;
            }

            $response = [
                'draw' => $draw,
                'recordsTotal' => $result->total(),
                'recordsFiltered' => $result->total(),
                'data' => $data_arr,
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'error' => $e->getMessage(),
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ];
            return response()->json($response, 500);
        }
    }
}