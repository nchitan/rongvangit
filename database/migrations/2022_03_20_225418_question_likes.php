<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('author_id');
            $table->integer('question_id');
            $table->timestamps();
            $table->unique(['user_id', 'question_id'], 'question_likes_unique_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
Schema::dropIfExists('question_likes');
    }
}
