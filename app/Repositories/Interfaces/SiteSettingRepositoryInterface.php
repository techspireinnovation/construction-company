<?php

namespace App\Repositories\Interfaces;

interface SiteSettingRepositoryInterface
{
    public function get(): ?\App\Models\SiteSetting;
    public function update(array $data, int $id);
}
