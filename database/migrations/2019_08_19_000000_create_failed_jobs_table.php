<?php

use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

class CreateFailedJobsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('failed_jobs', function (Blueprint $table) {
			$table->id();
			$table->string('uuid')->unique();
			$table->text('connection')->nullable();
			$table->text('queue')->nullable();
			$table->longText('payload')->nullable();
			$table->longText('exception')->nullable();
			$table->timestamp('failed_at')->useCurrent();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('failed_jobs');
	}
}
