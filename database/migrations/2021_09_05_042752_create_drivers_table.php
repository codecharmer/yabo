<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateDriversTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drivers', function (Blueprint $table) {
			$table->bigInteger('id')->primary();
			$table->text('registration_certificate')->nullable();
			$table->text('driving_licence')->nullable();
			$table->text('pollution_certificate')->nullable();
			$table->text('aadhar')->nullable();
			$table->text('pan')->nullable();
			$table->string('bank_account_no')->nullable();
			$table->string('bank_name')->nullable();
			$table->string('branch_name')->nullable();
			$table->string('micr')->nullable();
			$table->string('ifsc')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('drivers');
	}
}
