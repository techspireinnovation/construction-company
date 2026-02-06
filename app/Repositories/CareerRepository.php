<?php

namespace App\Repositories;

use App\Models\Career;
use App\Models\SeoDetail;
use App\Repositories\Interfaces\CareerRepositoryInterface;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Support\Facades\DB;

class CareerRepository implements CareerRepositoryInterface
{
    protected ImageService $imageService;
    protected SlugService $slugService;

    // Define SEO type for Career
    protected const SEO_TYPE = 4;

    public function __construct(ImageService $imageService, SlugService $slugService)
    {
        $this->imageService = $imageService;
        $this->slugService = $slugService;
    }

    public function all()
    {
        return Career::latest()->paginate(10);
    }

    public function store(array $data)
    {
        // Generate slug
        $data['slug'] = $this->slugService->generate(Career::class, $data['job_title']);

        // Handle banner image upload
        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->store($data['banner_image'], 'careers/banners');
        }

        $data['status'] = $data['status'] ?? 0;

        // Sanitize requirements and responsibilities
        $data = $this->sanitizeArrays($data);

        // Create career
        $career = Career::create($data);

        // Save SEO
        $this->storeOrUpdateSeo($data, $career->id);

        return $career;
    }

    public function find(int $id): Career
    {
        // Load SEO detail to pass to edit view
        return Career::with('seoDetail')->findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $career = Career::findOrFail($id);

        // Update slug if job title changed
        if (isset($data['job_title'])) {
            $data['slug'] = $this->slugService->generate(Career::class, $data['job_title'], $career->id);
        }

        $data['status'] = $data['status'] ?? 0;

        // Replace banner image if uploaded
        if (isset($data['banner_image'])) {
            $data['banner_image'] = $this->imageService->replace($career->banner_image, $data['banner_image'], 'careers/banners');
        }

        // Sanitize requirements and responsibilities
        $data = $this->sanitizeArrays($data);

        $career->update($data);

        // Update SEO
        $this->storeOrUpdateSeo($data, $career->id);

        return $career;
    }

    public function delete(int $id)
    {
        $career = $this->find($id);

        $this->imageService->delete($career->banner_image);

        SeoDetail::where('reference_id', $career->id)
            ->where('type', self::SEO_TYPE)
            ->delete();

        $career->delete();
    }

    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $careers = Career::whereIn('id', $ids)->get();

            foreach ($careers as $career) {
                $this->imageService->delete($career->banner_image);

                SeoDetail::where('reference_id', $career->id)
                    ->where('type', self::SEO_TYPE)
                    ->delete();
            }

            Career::whereIn('id', $ids)->delete();
        });
    }

    public function toggleStatus(int $id): array
    {
        $career = Career::findOrFail($id);
        $career->status = !$career->status;
        $career->save();

        return [
            'success' => true,
            'status' => $career->status
        ];
    }

    protected function sanitizeSeoKeywords($keywords): array
    {
        if (empty($keywords)) {
            return [];
        }

        // If JSON string
        if (is_string($keywords)) {
            $decoded = json_decode($keywords, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $keywords = $decoded;
            } else {
                $keywords = explode(',', $keywords);
            }
        }

        $keywords = array_map('trim', $keywords);
        $keywords = array_filter($keywords);
        $keywords = array_values(array_unique($keywords));

        return $keywords;
    }

    /**
     * Sanitize SEO keywords and store as proper JSON array
     */
    protected function storeOrUpdateSeo(array $data, int $careerId)
    {
        $seoData = [
            'seo_title' => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'seo_keywords' => $this->sanitizeSeoKeywords($data['seo_keywords'] ?? null),
        ];

        if (isset($data['seo_image'])) {
            $seoData['seo_image'] = $this->imageService->store($data['seo_image'], 'seo_images');
        }

        SeoDetail::updateOrCreate(
            ['reference_id' => $careerId, 'type' => self::SEO_TYPE],
            $seoData
        );
    }



    /**
     * Sanitize arrays to prevent duplicates
     */
    protected function sanitizeArrays(array $data): array
    {
        // Handle requirements
        if (isset($data['requirements'])) {
            if (is_string($data['requirements'])) {
                $data['requirements'] = json_decode($data['requirements'], true) ?? [];
            }

            if (is_array($data['requirements'])) {
                // Trim, filter empty, remove duplicates
                $data['requirements'] = array_map('trim', $data['requirements']);
                $data['requirements'] = array_filter($data['requirements']);
                $data['requirements'] = array_unique($data['requirements']);
                $data['requirements'] = array_values($data['requirements']); // Re-index

                // Encode as JSON for database storage
                $data['requirements'] = json_encode($data['requirements']);
            }
        }

        // Handle responsibilities
        if (isset($data['responsibilities'])) {
            if (is_string($data['responsibilities'])) {
                $data['responsibilities'] = json_decode($data['responsibilities'], true) ?? [];
            }

            if (is_array($data['responsibilities'])) {
                // Trim, filter empty, remove duplicates
                $data['responsibilities'] = array_map('trim', $data['responsibilities']);
                $data['responsibilities'] = array_filter($data['responsibilities']);
                $data['responsibilities'] = array_unique($data['responsibilities']);
                $data['responsibilities'] = array_values($data['responsibilities']); // Re-index

                // Encode as JSON for database storage
                $data['responsibilities'] = json_encode($data['responsibilities']);
            }
        }

        return $data;
    }
}