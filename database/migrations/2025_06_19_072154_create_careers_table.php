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
        Schema::create('careers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_title', 100);
            $table->string('slug', 100)->unique();
            $table->tinyInteger('employment_type')->default(0)->comment('0=Full-time, 1=Part-time');
            $table->string('experience_required', 100)->nullable();
            $table->tinyInteger('education_level')
                ->comment('0=No formal education, 1=Basic(Up to Grade 8), 2=SEE/SLC, 3=+2, 4=Diploma, 5=Graduate(Bachelor), 6=Postgraduate(Master), 7=PhD');
            $table->string('salary_range', 100); // e.g., $18 - $22/hr, $50k - $60k
            $table->string('shift_duration', 100);
            $table->text('short_summery');
            $table->text('description');
            $table->json('requirements');
            $table->json('responsibilities');
            $table->date('application_deadline');
            $table->string('banner_image')->nullable();

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
        Schema::dropIfExists('careers');
    }
};
