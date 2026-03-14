<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelTable extends Migration
{
    public function up()
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('ringkasan', 500)->nullable();
            $table->longText('isi_artikel');
            $table->string('foto')->nullable();
            $table->string('teks_foto')->nullable();
            $table->string('penulis')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikel');
    }
}
