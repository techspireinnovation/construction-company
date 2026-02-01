<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\SeoDetail;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    protected ImageService $imageService;
    protected SlugService $slugService;

    public function __construct(ImageService $imageService, SlugService $slugService)
    {
        $this->imageService = $imageService;
        $this->slugService = $slugService;
    }

    public function all()
    {
        return Service::latest()->paginate(10);
    }

    public function store(array $data)
    {
        // Generate slug
        $data['slug'] = $this->slugService->generate(Service::class, $data['title']);

        // Upload images
        if (isset($data['image'])) {
            $data['image'] = $this->imageService->store($data['image'], 'services');
        }

        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->store($data['banner_image'], 'services/banners');
        }

        $data['status'] = $data['status'] ?? 0;

        // Create service
        $service = Service::create($data);

        // Save SEO details
        $this->storeOrUpdateSeo($data, $service->id);

        return $service;
    }

    public function find(int $id)
    {
        return Service::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $service = $this->find($id);

        if (isset($data['title'])) {
            $data['slug'] = $this->slugService->generate(Service::class, $data['title'], $service->id);
        }

        $data['status'] = $data['status'] ?? 0;

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->replace($service->image, $data['image'], 'services');
        }

        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->replace($service->banner_image, $data['banner_image'], 'services/banners');
        }

        $service->update($data);

        // Update SEO
        $this->storeOrUpdateSeo($data, $service->id);

        return $service;
    }

    public function delete(int $id)
    {
        $service = $this->find($id);

        $this->imageService->delete($service->image);
        $this->imageService->delete($service->banner_image);

        SeoDetail::where('reference_id', $service->id)
            ->where('type', 3)
            ->delete();

        $service->delete();
    }
    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $services = Service::whereIn('id', $ids)->get();

            foreach ($services as $service) {
                // Delete images
                $this->imageService->delete($service->image);
                $this->imageService->delete($service->banner_image);

                // Delete SEO details
                SeoDetail::where('reference_id', $service->id)
                    ->where('type', 3)
                    ->delete();
            }

            // Delete all services in one query
            Service::whereIn('id', $ids)->delete();
        });
    }

    // New method for toggle status
    public function toggleStatus(int $id): array
    {
        $service = $this->find($id);

        // Toggle status
        $service->status = !$service->status;
        $service->save();

        return [
            'success' => true,
            'status' => $service->status
        ];
    }
    protected function storeOrUpdateSeo(array $data, int $serviceId)
    {
        $seoData = [
            'seo_title' => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'seo_keywords' => isset($data['seo_keywords']) ? explode(',', $data['seo_keywords']) : [],
        ];

        if (isset($data['seo_image'])) {
            $seoData['seo_image'] = $this->imageService->store($data['seo_image'], 'seo_images');
        }

        SeoDetail::updateOrCreate(
            ['reference_id' => $serviceId, 'type' => 3],
            $seoData
        );
    }

}
