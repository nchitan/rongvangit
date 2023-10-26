<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdeaTagGrps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_tag_grps', function (Blueprint $table) {
            $table->id();
            $table->integer('idea_id');
            $table->integer('tag_id');
            $table->integer('status')->default(1)->comment('1: Activate, 0 Delete');
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
        Schema::dropIfExists('idea_tag_grps');
    }
}
