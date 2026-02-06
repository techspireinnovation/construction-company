<?php

namespace App\Repositories\Interfaces;

interface PageRepositoryInterface
{
    public function all();
    public function store(array $data);
    public function find(int $id);
    public function update(array $data, int $id);
    public function toggleStatus(int $id);
    public function updateOrder(array $orderData): void;
}
