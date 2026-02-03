<?php

namespace App\Repositories\Interfaces;

interface BlogCategoryRepositoryInterface
{
    public function all();
    public function store(array $data);
    public function find(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function toggleStatus(int $id): array;
}
