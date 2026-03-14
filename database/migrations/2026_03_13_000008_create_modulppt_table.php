<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulpptTable extends Migration
{
    public function up()
    {
        Schema::create('modulppt', function (Blueprint $table) {
            $table->bigIncrements('id_modul');
            $table->string('nama_modul');
            $table->decimal('harga', 15, 2)->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('type_file')->nullable();
            $table->string('cover')->nullable();
            $table->text('modul_link')->nullable();
            $table->text('landing_page_link')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modulppt');
    }
}
