<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\SeoDetail;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Support\Facades\DB;

class BlogRepository implements BlogRepositoryInterface
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
        return Blog::with('category')->latest()->paginate(10); 
    }



    public function store(array $data)
    {
        $data['slug'] = $this->slugService->generate(Blog::class, $data['title']);
        $data['image'] = $this->imageService->store($data['image'], 'blogs');
        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->store($data['banner_image'], 'blogs/banners');
        }
        $data['status'] = $data['status'] ?? 0;

        $blog = Blog::create($data);

        $this->storeOrUpdateSeo($data, $blog->id);

        return $blog;
    }

    public function find(int $id)
    {
        return Blog::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $blog = $this->find($id);

        if (isset($data['title'])) {
            $data['slug'] = $this->slugService->generate(Blog::class, $data['title'], $blog->id);
        }
        $data['status'] = $data['status'] ?? 0;

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->replace($blog->image, $data['image'], 'blogs');
        }
        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->replace($blog->banner_image, $data['banner_image'], 'blogs/banners');
        }

        $blog->update($data);

        $this->storeOrUpdateSeo($data, $blog->id);

        return $blog;
    }

    public function delete(int $id)
    {
        $blog = $this->find($id);
        $this->imageService->delete($blog->image);
        $this->imageService->delete($blog->banner_image);

        SeoDetail::where('reference_id', $blog->id)
            ->where('type', 2)
            ->delete();

        $blog->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $blogs = Blog::whereIn('id', $ids)->get();
            foreach ($blogs as $blog) {
                $this->imageService->delete($blog->image);
                $this->imageService->delete($blog->banner_image);

                SeoDetail::where('reference_id', $blog->id)
                    ->where('type', 2)
                    ->delete();
            }
            Blog::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $blog = $this->find($id);
        $blog->status = !$blog->status;
        $blog->save();

        return ['success' => true, 'status' => $blog->status];
    }

    protected function storeOrUpdateSeo(array $data, int $blogId)
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
            ['reference_id' => $blogId, 'type' => 2],
            $seoData
        );
    }
}
