<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenuTable extends Migration
{
    public function up()
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->bigIncrements('id_role_menu');
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_menu');
            $table->boolean('ucc')->default(false);
            $table->boolean('ucu')->default(false);
            $table->boolean('ucd')->default(false);
            $table->uuid('uuid')->unique();
            $table->timestamps();

            $table->unique(['id_role', 'id_menu']);
            $table->foreign('id_role')->references('id_role')->on('role')->onDelete('cascade');
            $table->foreign('id_menu')->references('id_menu')->on('menu')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_menu');
    }
}
