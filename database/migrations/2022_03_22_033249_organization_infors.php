<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrganizationInfors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_infors', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id')->unique();
            $table->integer('post_count')->nullable();
            $table->integer('like_count_all')->nullable();
            $table->integer('folower_count')->nullable();
            $table->string('homepage')->nullable();
            $table->string('email')->unique();
            $table->string('adress')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_infors');
    }
}
