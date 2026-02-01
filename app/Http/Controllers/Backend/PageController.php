<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Models\PageType;
use App\Traits\ImageCrop;
use App\Models\PageContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    use ImageCrop;
    protected $folderPath = 'page';
    protected $path;

    public function __construct()
    {
        $this->folderPath = 'page';
        $this->path = storage_path('app/public/' . $this->folderPath);

        if (!file_exists($this->path)) {
            Storage::disk('public')->makeDirectory($this->folderPath);
            if (file_exists($this->path)) {
                chmod($this->path, 0755);
            }
        }
    }

    public function index(Request $request)
    {
        return view('admin.pages.index');
    }

    public function create()
    {
        $pageTypes = PageType::where('status', 1)->get();
        return view('admin.pages.create', compact('pageTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|max:255|unique:pages,slug',
            'title' => 'required',
            'page_type_id' => 'required|exists:page_types,id',
            'section_title.*' => 'nullable|string',
            'content.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Could not create')->withInput()->withErrors($validator);
        }

        \DB::beginTransaction();
        try {
            // If assigning a non-default page type (id != 1), reset any existing page with the same type to Default (id = 1) and status = 0
            if ($request->page_type_id != 1) {
                Page::where('page_type_id', $request->page_type_id)
                    ->update([
                        'page_type_id' => 1,
                        'status' => 0
                    ]);
            }

            $seoImageName = '';
            if ($request->hasFile('seo_image')) {
                $image = $request->file('seo_image');
                $seoImageName = time() . '.' . $image->extension();
                $this->cropImage(1200, 630, $image, $this->folderPath . '/seo_' . $seoImageName);
            }

            $page = Page::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'page_type_id' => $request->page_type_id,
                'page_above' => $request->page_above,
                'page_below' => $request->page_below,
                'seo_title' => $request->seo_title,
                'seo_keyword' => $request->seo_keyword,
                'seo_description' => $request->seo_description,
                'status' => $request->has('status') && $request->status == 'on' ? 1 : 0,
                'menu' => $request->has('menu') && $request->menu == 'on' ? 1 : 0,
                'seo_image' => $seoImageName,
            ]);

            if ($request->section_title) {
                foreach ($request->section_title as $i => $title) {
                    if (!empty($title) || !empty($request->content[$i])) {
                        $page_content = new PageContent();
                        $page_content->page_id = $page->id;
                        $page_content->title = $title ?? '';
                        $page_content->link = $request->link[$i] ?? '';
                        $page_content->content = $request->content[$i] ?? '';
                        $page_content->subtitle = $request->section_subtitle[$i] ?? '';
                        $page_content->text = $request->text[$i] ?? '';
                        if (isset($request->image[$i]) && $request->image[$i]->isValid()) {
                            $imageName = rand(5, 10) . time() . '.' . $request->image[$i]->extension();
                            Storage::disk('public')->putFileAs($this->folderPath, $request->image[$i], $imageName);
                            $page_content->image = $imageName;
                        }
                        $page_content->save();
                    }
                }
            }

            \DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $page->contents = PageContent::where('page_id', $id)->get();
        $pageTypes = PageType::where('status', 1)->get();
        return view('admin.pages.edit', compact('page', 'pageTypes'));
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $validator = Validator::make($request->all(), [
                'slug' => 'required|max:255|unique:pages,slug,' . $id,
                'title' => 'required',
                'page_type_id' => 'required|exists:page_types,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Could not update')->withInput()->withErrors($validator);
            }

            \DB::beginTransaction();
            $page = Page::findOrFail($id);

            // If assigning a non-default page type (id != 1), reset any existing page with the same type to Default (id = 1) and status = 0
            if ($request->page_type_id != 1 && $page->page_type_id != $request->page_type_id) {
                Page::where('page_type_id', $request->page_type_id)
                    ->where('id', '!=', $id)
                    ->update([
                        'page_type_id' => 1,
                        'status' => 0
                    ]);
            }

            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->page_type_id = $request->page_type_id;
            $page->page_above = $request->page_above;
            $page->page_below = $request->page_below;
            $page->seo_title = $request->seo_title;
            $page->seo_keyword = $request->seo_keyword;
            $page->seo_description = $request->seo_description;
            $page->status = ($request->status == 'on') ? 1 : 0;
            $page->menu = ($request->menu == 'on') ? 1 : 0;

            if ($request->hasFile('seo_image')) {
                $image = $request->file('seo_image');
                $oldImg = $page->seo_image;
                $seoImageName = time() . '.' . $image->extension();
                $this->cropImage(1200, 630, $image, $this->folderPath . '/seo_' . $seoImageName);
                $page->seo_image = $seoImageName;
                if ($oldImg) {
                    Storage::delete('public/page/seo_' . $oldImg);
                }
            }

            foreach ($request->content_id as $i => $content_id) {
                $page_content = PageContent::where('id', $content_id)->first();
                $page_content->content = $request->content[$i];
                $page_content->link = $request->link[$i];
                $page_content->title = $request->section_title[$i];
                $page_content->subtitle = $request->section_subtitle[$i];
                $page_content->text = $request->text[$i];

                if (isset($request->image[$i]) && $request->image[$i]->isValid()) {
                    $imageName = rand(5, 10) . time() . '.' . $request->image[$i]->extension();
                    Storage::disk('public')->putFileAs($this->folderPath, $request->image[$i], $imageName);
                    if ($page_content->image) {
                        Storage::disk('public')->delete($this->folderPath . '/' . $page_content->image);
                    }
                    $page_content->image = $imageName;
                }
                $page_content->save();
            }
            $page->save();
            \DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {
            \DB::rollback();
            return redirect()->route('admin.pages.index')->with('error', 'Something went wrong: ' . $ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            Schema::disableForeignKeyConstraints();
            Page::where('id', $request->id)->delete();
            Schema::enableForeignKeyConstraints();
            return redirect()->route('admin.pages.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.pages.index')->with('error', $ex->getMessage());
        }
    }

    public function updatePageType(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pages,id',
            'page_type_id' => 'required|exists:page_types,id',
        ]);

        \DB::beginTransaction();
        try {
            $page = Page::find($request->id);
            $newPageTypeId = $request->page_type_id;

            // If assigning a non-default page type (id != 1), reset any existing page with the same type to Default (id = 1) and status = 0
            if ($newPageTypeId != 1 && $page->page_type_id != $newPageTypeId) {
                Page::where('page_type_id', $newPageTypeId)
                    ->where('id', '!=', $request->id)
                    ->update([
                        'page_type_id' => 1,
                        'status' => 0
                    ]);
            }

            // Update the current page
            $page->page_type_id = $newPageTypeId;
            $page->status = 1; // Ensure the page is active
            $page->save();

            \DB::commit();
            return response()->json(['success' => true, 'message' => 'Page type updated successfully']);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $draw = intval($request->get('draw'));
            $start = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15)));

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

            $result = Page::query();
            $result = $result->where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('pages.title', 'LIKE', '%' . $keyword . '%');
                }
            })
                ->with('pageType')
                ->latest()
                ->paginate($paginate);

            $data_arr = [];
            $sn = 1;
            foreach ($result as $record) {
                $data_arr[] = [
                    "sn" => $sn,
                    "id" => $record->id,
                    "title" => $record->title,
                    "slug" => $record->slug,
                    "status" => $record->status,
                    "page_type_id" => $record->page_type_id,
                    "action" => '',
                ];
                $sn++;
            }

            $response = [
                "draw" => intval($draw),
                "recordsTotal" => $result->total(),
                "recordsFiltered" => $result->total(),
                "total_amount" => 0,
                "data" => $data_arr,
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                "error" => $e->getMessage(),
                "draw" => intval($draw),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "total_amount" => 0,
                "data" => []
            ];

            return response()->json($response, 500);
        }
    }
}