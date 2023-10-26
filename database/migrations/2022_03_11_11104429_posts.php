<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('title');
            $table->longText('editor');
            $table->longText('content');
            $table->string('item')->unique();
            $table->integer('status')->default(1)->comment('1: Pushlish, 2: Draft, 3: Edit');
            $table->integer('view')->default(0);
            $table->integer('serie_id')->nullable();
            $table->unique(['user_id', 'title'], 'posts_unique_key');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
