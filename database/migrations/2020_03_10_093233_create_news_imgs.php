<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsImgs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img_url');
            $table->integer('sort')->default(0);
            $table->string('title');
            $table->string('content');
            $table->integer('type_id');
            $table->integer('price');
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
        Schema::dropIfExists('news_imgs');
    }
}
