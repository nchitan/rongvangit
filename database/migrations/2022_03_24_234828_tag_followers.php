<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagFollowers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_followers', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->unique(['tag_id', 'user_id'], 'tag_followers_unique_key');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_followers');
    }
}
