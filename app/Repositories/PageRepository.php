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

    /**
     * Get all pages with nested children for nestable display
     */
    public function all()
    {
        return Page::with([
            'children' => function ($q) {
                $q->orderBy('order_no')->with('children');
            }
        ])
            ->whereNull('parent_id')
            ->orderBy('order_no')
            ->get();
    }

    /**
     * Store a new page
     */
    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            if (isset($data['banner_image'])) {
                $data['banner_image'] = $this->imageService->store($data['banner_image'], 'pages');
            }

            $data['status'] = $data['status'] ?? 0;
            $data['parent_id'] = $data['parent_id'] ?? null;

            // Calculate order_no per parent
            $maxOrder = Page::where('parent_id', $data['parent_id'])->max('order_no');
            $data['order_no'] = ($maxOrder ?? 0) + 1;

            $page = Page::create($data);

            $this->storeOrUpdateSeo($data, $page->id);

            DB::commit();
            return $page;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Find a page with its children for nestable operations
     */
    public function find(int $id)
    {
        return Page::with(['children'])->findOrFail($id);
    }

    /**
     * Update a page
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();

        try {
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

            DB::commit();
            return $page;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Toggle status - needed for UI controls
     */
    public function toggleStatus(int $id)
    {
        $page = $this->find($id);
        $page->status = !$page->status;
        $page->save();
    }

    /**
     * Update order from nestable drag & drop
     */
    public function updateOrder(array $orderData): void
    {
        DB::beginTransaction();

        try {
            // If orderData is empty, nothing to do
            if (empty($orderData)) {
                DB::commit();
                return;
            }

            // Process the order recursively
            $this->processOrderRecursive($orderData, null);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Recursively process order data
     */
    private function processOrderRecursive(array $items, ?int $parentId): void
    {
        foreach ($items as $index => $item) {
            // Find the page
            $page = Page::find($item['id']);

            if ($page) {
                // Update the page's order and parent
                $page->update([
                    'order_no' => $index + 1, // Convert from 0-based to 1-based
                    'parent_id' => $parentId
                ]);

                // If this item has children, process them recursively
                if (!empty($item['children'])) {
                    $this->processOrderRecursive($item['children'], $item['id']);
                }
            }
        }
    }

    /**
     * Get parent options for dropdown (needed for creating/editing pages)
     */
    public function getParentOptions($excludeId = null)
    {
        $query = Page::whereNull('parent_id')
            ->orderBy('order_no');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }

    /**
     * Store or update SEO detail
     */
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