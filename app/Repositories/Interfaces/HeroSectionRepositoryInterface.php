<?php

namespace App\Repositories\Interfaces;

use App\Models\HeroSection;

interface HeroSectionRepositoryInterface
{
    public function get(): ?HeroSection;

    public function storeOrUpdate(array $data): HeroSection;

    public function deleteImages(): void;
}
