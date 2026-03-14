<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasiTable extends Migration
{
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal')->nullable()->index();
            $table->string('nama')->nullable();
            $table->string('whatsapp', 30)->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->longText('pertanyaan');
            $table->longText('jawaban')->nullable();
            $table->unsignedTinyInteger('status')->default(7)->index();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konsultasi');
    }
}
