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
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->text('description');
            $table->json('mission')
            ->comment('image, content');
            $table->json('vision')
            ->comment('image, content');
            $table->unsignedInteger('years_of_experience');
            $table->unsignedInteger('no_of_projects');
            $table->unsignedInteger('no_of_employees');
            $table->unsignedInteger('no_of_satisfied_clients');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
