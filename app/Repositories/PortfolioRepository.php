<?php

namespace App\Repositories;

use App\Models\Portfolio;
use App\Models\SeoDetail;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Support\Facades\DB;

class PortfolioRepository implements PortfolioRepositoryInterface
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
        return Portfolio::latest()->paginate(10);
    }

    public function store(array $data)
    {
        $data['slug'] = $this->slugService->generate(Portfolio::class, $data['title']);
        $data['status'] = $data['status'] ?? 0;

        // Upload banner
        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->store($data['banner_image'], 'portfolios/banners');
        }

        // Upload multiple images
        if (!empty($data['images'])) {
            $images = [];
            foreach ($data['images'] as $img) {
                $images[] = $this->imageService->store($img, 'portfolios/images');
            }
            $data['images'] = json_encode($images);
        }

        $portfolio = Portfolio::create($data);

        // SEO type = 5
        $this->storeOrUpdateSeo($data, $portfolio->id);

        return $portfolio;
    }

    public function find(int $id)
    {
        return Portfolio::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $portfolio = $this->find($id);
        $data['status'] = $data['status'] ?? 0;

        // Slug update
        if (isset($data['title'])) {
            $data['slug'] = $this->slugService->generate(Portfolio::class, $data['title'], $portfolio->id);
        }

        // Banner
        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->replace($portfolio->banner_image, $data['banner_image'], 'portfolios/banners');
        }

        // Multiple images
        if (!empty($data['images'])) {
            $existingImages = json_decode($portfolio->images, true) ?? [];
            foreach ($data['images'] as $img) {
                $existingImages[] = $this->imageService->store($img, 'portfolios/images');
            }
            $data['images'] = json_encode($existingImages);
        }

        $portfolio->update($data);

        $this->storeOrUpdateSeo($data, $portfolio->id);

        return $portfolio;
    }

    public function delete(int $id)
    {
        $portfolio = $this->find($id);

        // Delete images
        if ($portfolio->images) {
            foreach (json_decode($portfolio->images) as $img) {
                $this->imageService->delete($img);
            }
        }

        $this->imageService->delete($portfolio->banner_image);

        SeoDetail::where('reference_id', $portfolio->id)
            ->where('type', 5)
            ->delete();

        $portfolio->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $portfolios = Portfolio::whereIn('id', $ids)->get();
            foreach ($portfolios as $portfolio) {
                $this->delete($portfolio->id);
            }
        });
    }

    public function toggleStatus(int $id): array
    {
        $portfolio = $this->find($id);
        $portfolio->status = !$portfolio->status;
        $portfolio->save();

        return ['success' => true, 'status' => $portfolio->status];
    }

    protected function storeOrUpdateSeo(array $data, int $portfolioId)
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
            ['reference_id' => $portfolioId, 'type' => 5],
            $seoData
        );
    }
}
