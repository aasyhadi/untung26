<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPelatihanTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_pelatihan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama_pelatihan');
            $table->date('tanggal')->nullable()->index();
            $table->string('durasi')->nullable();
            $table->string('narasumber')->nullable();
            $table->decimal('biaya', 15, 2)->nullable();
            $table->string('lokasi')->nullable();
            $table->unsignedBigInteger('metode')->nullable()->index();
            $table->longText('deskripsi')->nullable();
            $table->string('cover')->nullable();
            $table->text('link_pendaftaran')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_pelatihan');
    }
}
