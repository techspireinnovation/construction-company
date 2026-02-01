<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request): array
    {
        $route = $request->route();

        // Check if it's a single service or admin route
        $isSingle = $route && $route->parameter('service');
        $isAdmin = $route && str_contains($route->getPrefix(), 'admin');

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,

            'image_url' => $this->image
                ? asset('storage/' . $this->image)
                : null,

            'banner_image_url' => $this->banner_image
                ? asset('storage/' . $this->banner_image)
                : null,

            'status' => $this->status ? 'active' : 'inactive',

            // SEO fields included only for single view or admin routes
            $this->mergeWhen($isSingle || $isAdmin, [
                'seo_title' => $this->seo?->seo_title,
                'seo_description' => $this->seo?->seo_description,
                'seo_keywords' => $this->seo?->seo_keywords ?? [],
                'seo_image_url' => $this->seo?->seo_image
                    ? asset('storage/' . $this->seo->seo_image)
                    : null,
            ]),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
