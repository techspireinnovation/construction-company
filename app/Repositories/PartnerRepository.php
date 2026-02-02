<?php

namespace App\Repositories;

use App\Models\Partner;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class PartnerRepository implements \App\Repositories\Interfaces\PartnerRepositoryInterface
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function all()
    {
        return Partner::latest()->paginate(10);
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageService->store($data['image'], 'partners');
        }

        $data['status'] = $data['status'] ?? 0;

        return Partner::create($data);
    }

    public function find(int $id)
    {
        return Partner::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $partner = $this->find($id);

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->replace($partner->image, $data['image'], 'partners');
        }

        $data['status'] = $data['status'] ?? 0;

        $partner->update($data);

        return $partner;
    }

    public function delete(int $id)
    {
        $partner = $this->find($id);

        $this->imageService->delete($partner->image);

        $partner->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $partners = Partner::whereIn('id', $ids)->get();

            foreach ($partners as $partner) {
                $this->imageService->delete($partner->image);
            }

            Partner::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $partner = $this->find($id);

        $partner->status = !$partner->status;
        $partner->save();

        return ['success' => true, 'status' => $partner->status];
    }
}
