<?php

namespace App\Repositories;

use App\Models\PortfolioCategory;
use App\Repositories\Interfaces\PortfolioCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PortfolioCategoryRepository implements PortfolioCategoryRepositoryInterface
{
    public function all()
    {
        return PortfolioCategory::latest()->paginate(10);
    }

    public function store(array $data)
    {
        $data['status'] = $data['status'] ?? 0;
        return PortfolioCategory::create($data);
    }

    public function find(int $id)
    {
        return PortfolioCategory::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $category = $this->find($id);
        $data['status'] = $data['status'] ?? 0;
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->find($id);
        $category->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            PortfolioCategory::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $category = $this->find($id);
        $category->status = !$category->status;
        $category->save();
        return ['success' => true, 'status' => $category->status];
    }
}
