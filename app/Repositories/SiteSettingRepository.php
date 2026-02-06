<?php

namespace App\Repositories;

use App\Models\SiteSetting;
use App\Services\ImageService;

class SiteSettingRepository
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function all()
    {
        return SiteSetting::all();
    }

    public function find(int $id)
    {
        return SiteSetting::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $setting = $this->find($id);

        // Logo
        if (isset($data['logo_image'])) {
            $data['logo_image'] = $this->imageService->replace(
                $setting->logo_image,
                $data['logo_image'],
                'site_settings'
            );
        }

        // Favicon
        if (isset($data['fav_icon_image'])) {
            $data['fav_icon_image'] = $this->imageService->replace(
                $setting->fav_icon_image,
                $data['fav_icon_image'],
                'site_settings'
            );
        }

        $setting->update($data);

        return $setting;
    }
}
