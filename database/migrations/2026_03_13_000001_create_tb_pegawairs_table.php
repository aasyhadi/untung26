<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPegawairsTable extends Migration
{
    public function up()
    {
        Schema::create('tb_pegawairs', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai');
            $table->uuid('uuid')->unique();
            $table->string('nama_pegawai')->nullable();
            $table->string('email')->nullable();
            $table->string('telp', 30)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_pegawairs');
    }
}
