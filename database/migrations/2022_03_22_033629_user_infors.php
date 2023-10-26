<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserInfors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('folow_count')->default(0);
            $table->integer('folower_count')->default(0);
            $table->integer('contribution')->default(0);
            $table->integer('user_organization_id')->nullable();
            $table->string('email')->nullable();
            $table->string('adress')->nullable();
            $table->string('gihub')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linked')->nullable();
            $table->string('youtube')->nullable();
            $table->string('zalo')->nullable();
            $table->string('user_about')->nullable();
            $table->string('homepage')->nullable();
            $table->string('university')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infors');
    }
}
