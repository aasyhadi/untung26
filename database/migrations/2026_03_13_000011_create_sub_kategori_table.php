<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKategoriTable extends Migration
{
    public function up()
    {
        Schema::create('sub_kategori', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kategori')->default(0)->index();
            $table->string('nama_sub_kategori');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->uuid('uuid')->nullable()->unique();
            $table->timestamps();

            $table->unique(['id_kategori', 'nama_sub_kategori']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_kategori');
    }
}
