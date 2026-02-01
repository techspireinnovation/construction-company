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
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug', 100)->unique();
            $table->string('image');
            $table->string('banner_image')->nullable();
            $table->text('short_description');
            $table->text('description');
            $table->unsignedInteger('blog_category_id');
            $table->string('written_by')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['blog_category_id']);
        });
        Schema::dropIfExists('blogs');
    }
};
