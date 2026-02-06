<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug', 100)->unique();
            $table->string('image');
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}
