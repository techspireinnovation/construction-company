<?php

namespace App\Repositories;

use App\Models\Faq;
use Illuminate\Support\Facades\DB;

class FaqRepository implements \App\Repositories\Interfaces\FaqRepositoryInterface
{
    public function all()
    {
        return Faq::latest()->paginate(10);
    }

    public function store(array $data)
    {
        $data['status'] = $data['status'] ?? 0;

        return Faq::create($data);
    }

    public function find(int $id)
    {
        return Faq::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $faq = $this->find($id);

        $data['status'] = $data['status'] ?? 0;

        $faq->update($data);

        return $faq;
    }

    public function delete(int $id)
    {
        $faq = $this->find($id);
        $faq->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            Faq::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $faq = $this->find($id);

        $faq->status = !$faq->status;
        $faq->save();

        return ['success' => true, 'status' => $faq->status];
    }
}
