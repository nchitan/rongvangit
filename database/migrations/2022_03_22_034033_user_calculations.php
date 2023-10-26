<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserCalculations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_calculations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->integer('post_count')->default(0);
            $table->integer('answear_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->integer('question_count')->default(0);
            $table->integer('liked_post_count')->default(0);
            $table->integer('liked_comment_count')->default(0);
            $table->integer('liked_question_count')->default(0);
            $table->integer('liked_answear_count')->default(0);
            $table->integer('stocked_post_count')->default(0);
            $table->integer('request_aproval_count')->default(0);
            $table->integer('request_send_count')->default(0);
            $table->integer('folower_count_count')->default(0); 
            $table->integer('folowing_count')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_calculations');
    }
}
