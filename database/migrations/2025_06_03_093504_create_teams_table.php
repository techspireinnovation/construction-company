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
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('designation', 100);
            $table->string('image');
            $table->integer('order_no')->default(0);
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
