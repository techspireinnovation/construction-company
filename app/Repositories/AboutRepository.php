<?php

namespace App\Repositories;

use App\Models\About;
use App\Repositories\Interfaces\AboutRepositoryInterface;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class AboutRepository implements AboutRepositoryInterface
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function get(): ?About
    {
        return About::first();
    }

    public function storeOrUpdate(array $data): About
    {
        return DB::transaction(function () use ($data) {
            $about = About::first() ?? new About();
            $existingAbout = $this->get();

            $about->title = $data['title'];
            $about->description = $data['description'];

            // Handle mission
            if (isset($data['mission'])) {
                $missionData = $data['mission'][0];
                $mission = [
                    'content' => $missionData['content']
                ];

                // Handle mission image
                if (isset($missionData['image']) && $missionData['image']) {
                    // New image uploaded
                    $mission['image'] = $this->imageService->store($missionData['image'], 'about');

                    // Delete old mission image if it exists
                    if ($existingAbout && $existingAbout->mission) {
                        $existingMission = json_decode($existingAbout->mission, true);
                        if (!empty($existingMission[0]['image'])) {
                            $this->imageService->delete($existingMission[0]['image']);
                        }
                    }
                } elseif (isset($missionData['remove_image']) && $missionData['remove_image'] == '1') {
                    // Remove image checkbox checked
                    $mission['image'] = '';

                    // Delete the old image if it exists
                    if ($existingAbout && $existingAbout->mission) {
                        $existingMission = json_decode($existingAbout->mission, true);
                        if (!empty($existingMission[0]['image'])) {
                            $this->imageService->delete($existingMission[0]['image']);
                        }
                    }
                } elseif (isset($missionData['existing_image']) && !empty($missionData['existing_image'])) {
                    // Keep existing image
                    $mission['image'] = $missionData['existing_image'];
                } else {
                    // No image provided, keep existing or set empty
                    if ($existingAbout && $existingAbout->mission) {
                        $existingMission = json_decode($existingAbout->mission, true);
                        $mission['image'] = $existingMission[0]['image'] ?? '';
                    } else {
                        $mission['image'] = '';
                    }
                }

                $about->mission = json_encode([$mission]);
            }

            // Handle vision
            if (isset($data['vision'])) {
                $visionData = $data['vision'][0];
                $vision = [
                    'content' => $visionData['content']
                ];

                // Handle vision image
                if (isset($visionData['image']) && $visionData['image']) {
                    // New image uploaded
                    $vision['image'] = $this->imageService->store($visionData['image'], 'about');

                    // Delete old vision image if it exists
                    if ($existingAbout && $existingAbout->vision) {
                        $existingVision = json_decode($existingAbout->vision, true);
                        if (!empty($existingVision[0]['image'])) {
                            $this->imageService->delete($existingVision[0]['image']);
                        }
                    }
                } elseif (isset($visionData['remove_image']) && $visionData['remove_image'] == '1') {
                    // Remove image checkbox checked
                    $vision['image'] = '';

                    // Delete the old image if it exists
                    if ($existingAbout && $existingAbout->vision) {
                        $existingVision = json_decode($existingAbout->vision, true);
                        if (!empty($existingVision[0]['image'])) {
                            $this->imageService->delete($existingVision[0]['image']);
                        }
                    }
                } elseif (isset($visionData['existing_image']) && !empty($visionData['existing_image'])) {
                    // Keep existing image
                    $vision['image'] = $visionData['existing_image'];
                } else {
                    // No image provided, keep existing or set empty
                    if ($existingAbout && $existingAbout->vision) {
                        $existingVision = json_decode($existingAbout->vision, true);
                        $vision['image'] = $existingVision[0]['image'] ?? '';
                    } else {
                        $vision['image'] = '';
                    }
                }

                $about->vision = json_encode([$vision]);
            }

            // Stats
            if (isset($data['stats'])) {
                $about->stats = json_encode($data['stats']);
            }

            $about->save();

            return $about;
        });
    }
}