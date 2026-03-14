<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->bigIncrements('id_buku');
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit')->nullable();
            $table->string('isbn', 100)->nullable()->index();
            $table->unsignedSmallInteger('tahun_terbit')->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->decimal('harga_ebook', 15, 2)->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('cover')->nullable();
            $table->text('ebook_link')->nullable();
            $table->text('landing_page_link')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
