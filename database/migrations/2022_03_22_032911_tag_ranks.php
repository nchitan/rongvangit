<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagRanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_ranks', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id')->unique();
            $table->integer('post_count_week')->default(0);
            $table->integer('post_count_month')->default(0);
            $table->integer('post_count_all')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_ranks');
    }
}
