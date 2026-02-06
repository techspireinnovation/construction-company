<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSetting\UpdateRequest;
use App\Models\SiteSetting;
use App\Repositories\SiteSettingRepository;
use App\Services\ImageService;

class SiteSettingController extends Controller
{
    protected SiteSettingRepository $repository;
    protected ImageService $imageService;


    public function __construct(SiteSettingRepository $repository, ImageService $imageService)
    {
        $this->repository = $repository;
        $this->imageService = $imageService;

    }

    public function index()
    {
        $settings = $this->repository->all();
        return view('admin.site-settings.index', compact('settings'));
    }
    public function create()
    {
        return view('admin.site-settings.create');
    }

    public function store(UpdateRequest $request)
    {
        $data = $request->validated();

        // Handle logo & favicon if uploaded
        if (isset($data['logo_image'])) {
            $data['logo_image'] = $this->imageService->store($data['logo_image'], 'site_settings');
        }

        if (isset($data['fav_icon_image'])) {
            $data['fav_icon_image'] = $this->imageService->store($data['fav_icon_image'], 'site_settings');
        }

        SiteSetting::create($data);

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Site setting created successfully.');
    }



    public function edit($id)
    {
        $setting = $this->repository->find($id);
        return view('admin.site-settings.edit', compact('setting'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->repository->update($request->validated(), $id);

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Site setting updated successfully.');
    }
}
