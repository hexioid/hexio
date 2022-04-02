<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Content extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')
            ->onDelete('cascade');
            $table->unsignedInteger('order_number');
            $table->unsignedBigInteger('content_type_id');
            $table->foreign('content_type_id')->references('id')->on('content_type');
            $table->unsignedBigInteger('link_type_id')->nullable();
            $table->foreign('link_type_id')->references('id')->on('link_type');
            $table->string("text")->nullable();
            $table->string("link")->nullable();
            $table->string("button_color")->nullable();
            $table->string("text_color")->nullable();
            $table->string("is_icon_displayed")->nullable();
            $table->enum('text_align', ['left', 'center', 'right', 'justify'])->nullable();
            $table->boolean("is_bold")->default(0);
            $table->boolean("is_italic")->default(0);
            $table->boolean("is_underline")->default(0);
            $table->boolean("is_content_displayed")->default(1);
            $table->unsignedInteger("total_clicked")->default(0);
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
        //
    }
}
