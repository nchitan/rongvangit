<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommentLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('author_id');
            $table->integer('post_id');
            $table->integer('comment_id');
            $table->timestamps();
            $table->unique(['user_id', 'comment_id'], 'comment_likes_unique_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('comment_likes');
    }
}
