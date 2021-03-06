<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function (Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id')->default(0);
			$table->string('recipient_name')->default(0);
			$table->string('recipient_phone')->default(0);
			$table->string('recipient_address')->default(0);
			$table->integer('shipment_time')->unsigned()->default(0);
			$table->string('total_price')->default(0);
			$table->string('shipment_status')->default(0);
            $table->string('payment_status')->default(0);
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
		Schema::dropIfExists('orders');
	}

}


