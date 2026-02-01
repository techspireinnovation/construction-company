<?php

namespace App\Http\Controllers\Backend;

use App\Models\PageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PageTypeController extends Controller
{
    public function index()
    {
        return view('admin.page_types.index');
    }

    public function search(Request $request)
    {
        try {
            $draw = intval($request->get('draw'));
            $start = intval($request->get('start'));
            $paginate = intval($request->get('length', env('PAGINATION', 15)));
    
            \Log::info('Search Request: ', $request->all());
    
            $result = PageType::latest()->paginate($paginate);
    
            \Log::info('PageType Records: ', $result->toArray());
    
            $data_arr = [];
            $sn = $start + 1;
            foreach ($result as $record) {
                $action = '';
                if ($record->id != 1) {
                    $edit = route('admin.page_types.edit', $record->id);
                    $action = '<div class="td-flex">' .
                        '<a href="' . $edit . '"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>' .
                        ' ' .
                        '<button type="button" class="btn btn-danger delete-btn" data-id="' . $record->id . '" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>' .
                        '</div>';
                }
    
                $data_arr[] = [
                    'sn' => $sn,
                    'id' => $record->id,
                    'name' => $record->name,
                    'status' => $record->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-warning">Inactive</span>',
                    'action' => $action,
                ];
                $sn++;
            }
    
            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $result->total(),
                'recordsFiltered' => $result->total(),
                'data' => $data_arr,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Search Error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ], 500);
        }
    }

    public function create()
    {
        return view('admin.page_types.create');
    }

    public function store(Request $request)
    {
        // Preprocess status to ensure it's boolean-compatible
        $data = $request->all();
        $data['status'] = $request->has('status') && $request->status == 'on' ? 1 : 0;
    
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:page_types,name',
            'status' => 'boolean',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Could not create')->withInput()->withErrors($validator);
        }
    
        PageType::create([
            'name' => $data['name'],
            'status' => $data['status'],
        ]);
    
        return redirect()->route('admin.page_types.index')->with('success', 'Page type created successfully.');
    }

    public function edit(PageType $pageType)
    {
        if ($pageType->id == 1) {
            return redirect()->route('admin.page_types.index')->with('error', 'Cannot edit the Default page type.');
        }
        return view('admin.page_types.edit', compact('pageType'));
    }

    public function update(Request $request, PageType $pageType)
    {
        if ($pageType->id == 1) {
            return redirect()->route('admin.page_types.index')->with('error', 'Cannot edit the Default page type.');
        }
    
        $data = $request->all();
        $data['status'] = $request->has('status') && $request->status == 'on' ? 1 : 0;
    
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:page_types,name,' . $pageType->id,
            'status' => 'boolean',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Could not update')->withInput()->withErrors($validator);
        }
    
        $pageType->update([
            'name' => $data['name'],
            'status' => $data['status'],
        ]);
    
        return redirect()->route('admin.page_types.index')->with('success', 'Page type updated successfully.');
    }

    public function destroy(PageType $pageType)
    {
        if ($pageType->id == 1) {
            return redirect()->route('admin.page_types.index')->with('error', 'Cannot delete the Default page type.');
        }

        if ($pageType->pages()->count() > 0) {
            return redirect()->route('admin.page_types.index')->with('error', 'Cannot delete page type as it is assigned to one or more pages.');
        }

        $pageType->delete();
        return redirect()->route('admin.page_types.index')->with('success', 'Page type deleted successfully.');
    }
}