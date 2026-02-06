<?php

namespace App\Repositories;

use App\Models\Testimonial;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class TestimonialRepository
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function all()
    {
        return Testimonial::latest()->paginate(10);
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageService->store($data['image'], 'testimonials');
        }

        $data['status'] = $data['status'] ?? 0;

        return Testimonial::create($data);
    }

    public function find(int $id)
    {
        return Testimonial::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $testimonial = $this->find($id);

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->replace($testimonial->image, $data['image'], 'testimonials');
        }

        $data['status'] = $data['status'] ?? 0;

        $testimonial->update($data);

        return $testimonial;
    }

    public function delete(int $id)
    {
        $testimonial = $this->find($id);

        $this->imageService->delete($testimonial->image);

        $testimonial->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $testimonials = Testimonial::whereIn('id', $ids)->get();

            foreach ($testimonials as $testimonial) {
                $this->imageService->delete($testimonial->image);
            }

            Testimonial::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $testimonial = $this->find($id);

        $testimonial->status = !$testimonial->status;
        $testimonial->save();

        return ['success' => true, 'status' => $testimonial->status];
    }
}
