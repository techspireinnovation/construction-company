<?php

namespace App\Repositories;

use App\Models\Gallery;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class GalleryRepository
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function all()
    {
        return Gallery::latest()->paginate(10);
    }

    public function store(array $data)
    {
        $images = [];

        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $images[] = $this->imageService->store($image, 'galleries');
            }
        }

        $data['images'] = $images;
        $data['status'] = $data['status'] ?? 0;

        return Gallery::create($data);
    }

    public function find(int $id)
    {
        return Gallery::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $gallery = $this->find($id);

        if (isset($data['images'])) {
            // delete old images
            foreach ($gallery->images as $image) {
                $this->imageService->delete($image);
            }

            $images = [];
            foreach ($data['images'] as $image) {
                $images[] = $this->imageService->store($image, 'galleries');
            }

            $data['images'] = $images;
        }

        $data['status'] = $data['status'] ?? 0;

        $gallery->update($data);

        return $gallery;
    }

    public function delete(int $id)
    {
        $gallery = $this->find($id);

        foreach ($gallery->images as $image) {
            $this->imageService->delete($image);
        }

        $gallery->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $galleries = Gallery::whereIn('id', $ids)->get();

            foreach ($galleries as $gallery) {
                foreach ($gallery->images as $image) {
                    $this->imageService->delete($image);
                }
            }

            Gallery::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $gallery = $this->find($id);

        $gallery->status = !$gallery->status;
        $gallery->save();

        return ['success' => true, 'status' => $gallery->status];
    }
}
