<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrganizationRanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_ranks', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id')->unique();
            $table->integer('like_count_month')->default(0);
            $table->integer('like_count_all')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_ranks');
    }
}
