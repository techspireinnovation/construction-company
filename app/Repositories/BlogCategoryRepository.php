<?php

namespace App\Repositories;

use App\Models\BlogCategory;
use App\Models\SeoDetail;
use App\Repositories\Interfaces\BlogCategoryRepositoryInterface;
use App\Services\ImageService;
use App\Services\SlugService;

class BlogCategoryRepository implements BlogCategoryRepositoryInterface
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
        return BlogCategory::latest()->paginate(10);
    }

    public function store(array $data)
    {
        $data['slug'] = $this->slugService->generate(BlogCategory::class, $data['title']);

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->store($data['image'], 'blog_categories');
        }

        $data['status'] = $data['status'] ?? 0;

        $category = BlogCategory::create($data);

        $this->storeOrUpdateSeo($data, $category->id);

        return $category;
    }

    public function find(int $id)
    {
        return BlogCategory::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $category = $this->find($id);

        if (isset($data['title'])) {
            $data['slug'] = $this->slugService->generate(
                BlogCategory::class,
                $data['title'],
                $category->id
            );
        }

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->replace(
                $category->image,
                $data['image'],
                'blog_categories'
            );
        }

        $data['status'] = $data['status'] ?? 0;

        $category->update($data);

        $this->storeOrUpdateSeo($data, $category->id);

        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->find($id);

        $this->imageService->delete($category->image);

        SeoDetail::where('reference_id', $category->id)
            ->where('type', 1)
            ->delete();

        $category->delete();
    }

    public function toggleStatus(int $id): array
    {
        $category = $this->find($id);

        $category->status = !$category->status;
        $category->save();

        return [
            'success' => true,
            'status' => $category->status
        ];
    }

    protected function storeOrUpdateSeo(array $data, int $categoryId)
    {
        $seoData = [
            'seo_title'       => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'seo_keywords'    => isset($data['seo_keywords'])
                ? explode(',', $data['seo_keywords'])
                : [],
        ];

        if (isset($data['seo_image'])) {
            $seoData['seo_image'] = $this->imageService->store(
                $data['seo_image'],
                'seo_images'
            );
        }

        SeoDetail::updateOrCreate(
            [
                'reference_id' => $categoryId,
                'type' => 1, 
            ],
            $seoData
        );
    }
}
