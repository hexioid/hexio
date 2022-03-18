<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('username');
            $table->string('phone');
            $table->longText('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('bio')->nullable();
            $table->string('frame_color')->nullable();
            $table->string('background_color')->nullable();
            $table->string('save_color')->nullable();
            $table->boolean('is_address_displayed')->default(1);
            $table->boolean('is_username_displayed')->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger("total_visit")->default(0);
            $table->rememberToken();
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
}
