<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->bigIncrements('id_user_role');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_role');
            $table->uuid('uuid')->nullable()->unique();
            $table->timestamps();

            $table->unique(['id_user', 'id_role']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_role')->references('id_role')->on('role')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
