<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pegawai')->nullable()->index();
            $table->uuid('uuid')->unique();
            $table->string('username')->unique();
            $table->string('nama_pengguna');
            $table->string('email')->nullable()->unique();
            $table->string('telp', 30)->nullable();
            $table->string('avatar')->nullable()->default('avatars/avatar-5.jpg');
            $table->string('name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->index(['username', 'id_pegawai']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
