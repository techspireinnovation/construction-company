<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reference_id');
            $table->tinyInteger('type')->comment('1=blog_categories,2=blogs,3=services,4=career, 5=portfolio_details, 6=pages');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->json('seo_keywords')->comment('Array of SEO keywords');
            $table->string('seo_image');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['reference_id', 'type']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_details');
    }
};
