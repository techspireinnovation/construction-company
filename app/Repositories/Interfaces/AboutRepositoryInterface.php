<?php

namespace App\Repositories\Interfaces;

use App\Models\About;

interface AboutRepositoryInterface
{
    public function get(): ?About;

    public function storeOrUpdate(array $data): About;
}
