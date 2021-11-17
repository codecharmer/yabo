<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateDriverPayoutTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('driver_payout', function (Blueprint $table) {
			$table->bigInteger('id')->primary();
			$table->bigInteger('user_id')->nullable();
			$table->string('amount')->nullable();
			$table->enum('status', ['pending', 'processing', 'completed'])->nullable();
			$table->string('transaction_mode')->nullable();
			$table->string('transaction_id')->nullable();
			$table->string('message')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->dateTime('created_date')->useCurrent();
			$table->dateTime('modified_date')->useCurrent();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('driver_payout');
	}
}
