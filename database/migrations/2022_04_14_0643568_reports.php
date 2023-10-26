<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('người tạo report');
            $table->integer('reported_id')->comment('người bị report');
            $table->string('item_type')->comment('1: post, 2:question, 3: comment, 4: answear');
            $table->integer('item_id');
            $table->text('data')->comment('1:CommunityGuidelineViolation, 2:IllegalViolation, 3:SociallyInappropriate, 4:SuspectedSpam');
            $table->string('status')->comment("0: unread 1:read, 2:checking, 3:NG, 4: OK")->default(0);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'reported_id', 'item_type', 'item_id']);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
