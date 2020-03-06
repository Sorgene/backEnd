<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_img', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('new_id');
            $table->string('img_url');
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
        Schema::rename('news_img',' news_imgs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_img');
    }
}