<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateCategoriesTable extends Migration
{
	/** Run the migrations.
	 *
	 * @return void */
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->bigInteger('id')->primary();
			$table->string('slug')->nullable();
			$table->string('title')->nullable();
			$table->enum('post_type', ['vehicle'])->default('VEHICLE');
			$table->string('extra_field')->nullable();
			$table->text('image')->nullable();
			$table->boolean('status')->nullable()->default(0);
			$table->bigInteger('created_by')->nullable();
			$table->timestamp('created_date')->useCurrent();
			$table->bigInteger('modified_by')->nullable();
			$table->timestamp('modified_date')->useCurrent()->useCurrentOnUpdate();
		});
	}

	/** Reverse the migrations.
	 *
	 * @return void */
	public function down()
	{
		Schema::dropIfExists('categories');
	}
}
