<?php

namespace App\Repositories;

use App\Models\HeroSection;
use App\Repositories\Interfaces\HeroSectionRepositoryInterface;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class HeroSectionRepository implements HeroSectionRepositoryInterface
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function get(): ?HeroSection
    {
        return HeroSection::first();
    }

    public function storeOrUpdate(array $data): HeroSection
    {
        return DB::transaction(function () use ($data) {
            $hero = HeroSection::first() ?? new HeroSection();
            $hero->type = $data['type'];

            if ($data['type'] == 2) {
                // Video type - store video data
                if (isset($data['hero_with_video'])) {
                    // Clean and validate the embed code
                    $embedCode = $this->cleanEmbedCode($data['hero_with_video']['embed'] ?? '');

                    $hero->hero_with_video = json_encode([
                        'title' => $data['hero_with_video']['title'] ?? '',
                        'content' => $data['hero_with_video']['content'] ?? '',
                        'embed' => $embedCode
                    ]);
                }
                $hero->hero_with_images = null;

                // Delete old images if switching from image to video type
                if ($hero->hero_with_images && $hero->type != $data['type']) {
                    $this->deleteImagesFromJson($hero->hero_with_images);
                }
            } else {
                // Image type - store images data
                if (isset($data['hero_with_images'])) {
                    $images = [];
                    $existingHero = $this->get();
                    $existingImages = $existingHero && $existingHero->hero_with_images
                        ? json_decode($existingHero->hero_with_images, true)
                        : [];

                    foreach ($data['hero_with_images'] as $index => $item) {
                        $imageData = [
                            'title' => $item['title'] ?? '',
                            'content' => $item['content'] ?? null,
                        ];

                        // Check if remove_image checkbox is checked
                        $shouldRemoveImage = isset($item['remove_image']) && $item['remove_image'] == '1';

                        // Handle image upload/update logic
                        if (isset($item['image']) && $item['image']) {
                            // New image uploaded
                            $imageData['image'] = $this->imageService->store($item['image'], 'hero');

                            // Delete old image if it exists (for edit form)
                            if (isset($existingImages[$index]['image']) && !empty($existingImages[$index]['image'])) {
                                $this->imageService->delete($existingImages[$index]['image']);
                            }
                        } elseif (!$shouldRemoveImage && isset($existingImages[$index]['image'])) {
                            // Keep existing image (if not removed)
                            $imageData['image'] = $existingImages[$index]['image'];
                        } elseif ($shouldRemoveImage && isset($existingImages[$index]['image'])) {
                            // Delete the image if remove checkbox is checked
                            $this->imageService->delete($existingImages[$index]['image']);
                            $imageData['image'] = '';
                        } else {
                            // If no existing image and no new image uploaded
                            $imageData['image'] = '';
                        }

                        $images[] = $imageData;
                    }

                    $hero->hero_with_images = json_encode($images);
                }
                $hero->hero_with_video = null;
            }

            $hero->save();
            return $hero;
        });
    }
    // Add this helper method to clean embed code
    private function cleanEmbedCode(string $embedCode): string
    {
        // Remove any script tags for security
        $embedCode = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $embedCode);

        // Ensure it's a valid iframe
        if (strpos($embedCode, '<iframe') === false) {
            // If it's just a YouTube URL, convert it to embed code
            if (
                preg_match('/youtube\.com\/watch\?v=([^&]+)/', $embedCode, $matches) ||
                preg_match('/youtu\.be\/([^?]+)/', $embedCode, $matches)
            ) {
                $videoId = $matches[1];
                $embedCode = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
            }
        }

        return trim($embedCode);
    }

    private function deleteImagesFromJson(?string $imagesJson): void
    {
        if (!$imagesJson)
            return;

        $images = json_decode($imagesJson, true);
        if (!$images || !is_array($images))
            return;

        foreach ($images as $img) {
            if (!empty($img['image'])) {
                $this->imageService->delete($img['image']);
            }
        }
    }

    public function deleteImages(): void
    {
        $hero = HeroSection::first();
        if ($hero && $hero->hero_with_images) {
            $this->deleteImagesFromJson($hero->hero_with_images);
        }
    }
}