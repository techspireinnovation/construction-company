<?php

namespace App\Repositories;

use App\Models\WhyChooseUs;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class WhyChooseUsRepository
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function all()
    {
        return WhyChooseUs::latest()->paginate(10);
    }

    public function store(array $data)
    {
        if (isset($data['icon'])) {
            $data['icon'] = $this->imageService->store($data['icon'], 'why_choose_us');
        }

        $data['status'] = $data['status'] ?? 0;

        return WhyChooseUs::create($data);
    }

    public function find(int $id)
    {
        return WhyChooseUs::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $item = $this->find($id);

        if (isset($data['icon'])) {
            $data['icon'] = $this->imageService->replace($item->icon, $data['icon'], 'why_choose_us');
        }

        $data['status'] = $data['status'] ?? 0;

        $item->update($data);

        return $item;
    }

    public function delete(int $id)
    {
        $item = $this->find($id);

        $this->imageService->delete($item->icon);

        $item->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $items = WhyChooseUs::whereIn('id', $ids)->get();

            foreach ($items as $item) {
                $this->imageService->delete($item->icon);
            }

            WhyChooseUs::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $item = $this->find($id);

        $item->status = !$item->status;
        $item->save();

        return ['success' => true, 'status' => $item->status];
    }
}
