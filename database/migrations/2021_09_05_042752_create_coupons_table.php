<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateCouponsTable extends Migration
{
	/** Run the migrations.
	 *
	 * @return void */
	public function up()
	{
		Schema::create('coupons', function (Blueprint $table) {
			$table->bigInteger('id')->primary();
			$table->string('code')->nullable()->unique();
			$table->string('type')->nullable();
			$table->boolean('is_active')->nullable();
			$table->dateTime('start_from')->useCurrent();
			$table->dateTime('end_to')->useCurrent();
			$table->integer('use_count')->nullable();
			$table->string('max_amount')->nullable();
			$table->string('percentage')->nullable();
			$table->string('min_order_amount')->nullable();
			$table->text('description')->nullable();
			$table->dateTime('created_date')->useCurrent();
			$table->dateTime('modified_date')->useCurrent();
		});
	}

	/** Reverse the migrations.
	 *
	 * @return void */
	public function down()
	{
		Schema::dropIfExists('coupons');
	}
}
