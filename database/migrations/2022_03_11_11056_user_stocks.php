<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('author_id');
            $table->integer('post_id');
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'post_id'], 'user_stock_unique_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_stocks');
    }
}
