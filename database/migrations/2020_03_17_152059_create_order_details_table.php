<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('ordrer_id')->unsigned()->default(0);
			$table->integer('product_id')->unsigned()->default(0);
			$table->integer('qty')->unsigned()->default(0);
            $table->integer('price')->unsigned()->default(0);
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
		Schema::drop('order_details');
	}

}
