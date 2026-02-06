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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug', 100)->unique();
            $table->unsignedInteger('portfolio_category_id');
            $table->unsignedInteger('partner_id');
            $table->string('banner_image')->nullable();
            $table->text('short_description');
            $table->text('description');
            $table->json('images');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('project_status')->default(0)->comment('0=completed, 1=ongoing, 2=upcoming');
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('portfolio_category_id')->references('id')->on('portfolio_categories')->cascadeOnDelete();
            $table->foreign('partner_id')->references('id')->on('partners')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropForeign(['portfolio_category_id']);
        });
        Schema::dropIfExists('portfolios');
    }
};
