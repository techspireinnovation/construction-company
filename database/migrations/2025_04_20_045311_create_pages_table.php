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
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->unique()->comment('1=home, 2=about us, 3=services, 4=team, 5= testimonial, 6=gallery, 7=portfolio, 8=blog, 9=career, 10=contact');
            $table->string('banner_image')->nullable();
            $table->integer('order_no')->default(0);
            $table->unsignedInteger('parent_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
