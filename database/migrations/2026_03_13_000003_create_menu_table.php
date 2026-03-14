<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id_menu');
            $table->unsignedBigInteger('id_menu_induk')->default(0)->index();
            $table->string('nama_menu');
            $table->string('url')->nullable()->index();
            $table->integer('urutan')->default(0);
            $table->string('icon')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();

            $table->unique(['id_menu_induk', 'nama_menu']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
