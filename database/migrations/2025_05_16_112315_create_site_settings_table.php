<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 100);
            $table->string('primary_mobile_no', 10);
            $table->string('secondary_mobile_no', 10)->nullable();
            $table->string('primary_email', 100);
            $table->string('secondary_email', 100)->nullable();
            $table->string('address');
            $table->text('embedded_map');
            $table->string('logo_image')->nullable();
            $table->string('footer_text');
            $table->string('fav_icon_image')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
