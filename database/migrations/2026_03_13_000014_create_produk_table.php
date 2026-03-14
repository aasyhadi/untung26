<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('ringkasan', 500)->nullable();
            $table->longText('ulasan');
            $table->decimal('harga', 15, 2)->default(0);
            $table->string('nomor_wa_order')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->unsignedInteger('urutan')->default(0);
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
