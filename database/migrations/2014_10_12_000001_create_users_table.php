<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('fullname')->nullable();

            $table->string('about')->nullable();
            $table->string('facebook')->nullable();
            $table->string('zalo')->nullable();
            $table->string('youtube')->nullable();
            $table->string('github')->nullable();
            $table->string('website')->nullable();
            $table->string('adress')->nullable();
            $table->string('university')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->integer('role_id')->default(6);
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
        Schema::dropIfExists('users');
    }
};
