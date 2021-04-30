<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 10)->unique();
            $table->string('password');
            $table->string('name', 20);
            $table->string('email', 64)->unique();
            $table->unsignedInteger('picture')->default(0);
            $table->integer('rating')->default(0);
            $table->enum('role',['user','admin'])->default('user');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
