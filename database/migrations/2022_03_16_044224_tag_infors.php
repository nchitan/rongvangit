<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagInfors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_infors', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id');
            $table->string('tag_about')->nullable();
            $table->string('tag_img')->nullable();
            $table->integer('post_count_all')->nullable();
            $table->integer('folower_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_infors');
    }
}
