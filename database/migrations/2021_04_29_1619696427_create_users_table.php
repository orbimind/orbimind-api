<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('username', 10)->unique()->charset('utf8')->collation('utf8_general_ci');
            $table->string('password')->charset('utf8')->collation('utf8_general_ci');
            $table->string('name', 20)->charset('utf8')->collation('utf8_general_ci');
            $table->string('email', 64)->unique()->charset('utf8')->collation('utf8_general_ci');
            $table->integer('rating')->default(0);
            $table->enum('role', ['user', 'admin'])->default('user')->charset('latin1')->collation('latin1_general_ci');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
