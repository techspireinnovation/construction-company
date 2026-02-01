<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageType;

class PageTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['id' => 1, 'name' => 'Default'],
            ['id' => 2, 'name' => 'Home'],
            ['id' => 3, 'name' => 'About Us'],
            ['id' => 4, 'name' => 'Services'],
            ['id' => 5, 'name' => 'Jobs'],
            ['id' => 6, 'name' => 'Contact'],
        ];

        foreach ($types as $type) {
            PageType::updateOrCreate(['id' => $type['id']], $type);
        }
    }
}