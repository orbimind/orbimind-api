<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 64)->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->integer('rating')->default(0);
            $table->boolean('status')->default(TRUE);
            $table->string('content', 4096)->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->json('category_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
