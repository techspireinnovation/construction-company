<?php

namespace App\Repositories;

use App\Models\Page;
use App\Models\SeoDetail;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function all()
    {
        return Page::with('seoDetail')
            ->orderBy('order_no')
            ->get();
    }

    public function store(array $data)
    {
        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->store($data['banner_image'], 'pages');
        }

        $data['status'] = $data['status'] ?? 0;
        $data['order_no'] = Page::max('order_no') + 1;

        $page = Page::create($data);

        $this->storeOrUpdateSeo($data, $page->id);

        return $page;
    }

    public function find(int $id)
    {
        return Page::with('seoDetail')->findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $page = $this->find($id);

        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->replace(
                $page->banner_image,
                $data['banner_image'],
                'pages'
            );
        }

        $data['status'] = $data['status'] ?? 0;
        $page->update($data);

        $this->storeOrUpdateSeo($data, $page->id);

        return $page;
    }

    public function toggleStatus(int $id)
    {
        $page = $this->find($id);
        $page->status = !$page->status;
        $page->save();
    }

    public function updateOrder(array $orders): void
    {
        DB::transaction(function () use ($orders) {
            foreach ($orders as $item) {
                Page::where('id', $item['id'])
                    ->update(['order_no' => $item['position']]);
            }
        });
    }

    protected function storeOrUpdateSeo(array $data, int $pageId)
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
            ['reference_id' => $pageId, 'type' => 6],
            $seoData
        );
    }
}
