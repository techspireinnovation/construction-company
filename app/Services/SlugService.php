<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugService
{
    /**
     * Generate a unique slug for any Eloquent model
     *
     * @param  class-string<Model>  $modelClass
     * @param  string               $title
     * @param  int|null             $ignoreId   (for update)
     */
    public function generate(
        string $modelClass,
        string $title,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while ($this->slugExists($modelClass, $slug, $ignoreId)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function slugExists(
        string $modelClass,
        string $slug,
        ?int $ignoreId = null
    ): bool {
        $query = $modelClass::withTrashed()->where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
