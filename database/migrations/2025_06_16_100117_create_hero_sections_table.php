<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->comment('1=images, 2=video');
            $table->json('hero_with_video')->nullable()
                ->comment('title, content, video');
            $table->json('hero_with_images')->nullable()
                ->comment('Array of {title, content, image}');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};