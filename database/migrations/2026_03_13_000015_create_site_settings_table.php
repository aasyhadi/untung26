<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name')->default('Untung Yasril');
            $table->string('site_domain_text')->default('untungyasril.com');
            $table->string('lokasi')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp_number', 30)->nullable();
            $table->string('whatsapp_default_message')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->text('profil_ringkas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
