<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateRatingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ratings', function (Blueprint $table) {
			$table->bigInteger('id')->primary();
			$table->bigInteger('user_id')->nullable();
			$table->bigInteger('reviewer_id')->nullable();
			$table->text('review')->nullable();
			$table->string('rate')->nullable();
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
		Schema::dropIfExists('ratings');
	}
}
