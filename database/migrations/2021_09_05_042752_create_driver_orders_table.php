<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateDriverOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('driver_orders', function (Blueprint $table) {
			$table->bigInteger('id')->primary();
			$table->bigInteger('user_order_id')->nullable();
			$table->bigInteger('driver_id')->nullable();
			$table->string('price')->nullable();
			$table->enum('type', ['normal', 'outdoor', 'upcoming'])->default('normal');
			$table->boolean('status')->nullable()->default(0);
			$table->enum('is_paid', ['paid', 'unpaid'])->nullable()->default('unpaid');
			$table->bigInteger('created_by')->nullable();
			$table->dateTime('created_date')->useCurrent();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('driver_orders');
	}
}
