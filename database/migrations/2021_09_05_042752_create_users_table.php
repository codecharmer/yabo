<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->bigInteger('id')->primary();
			$table->integer('category_id')->nullable()->default(1);
			$table->text('uuid')->nullable();
			$table->string('user_ip')->nullable();
			$table->string('username')->nullable();
			$table->string('slug')->nullable();
			$table->string('email')->nullable();
			$table->string('mobile', 24)->nullable();
			$table->string('password')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('profile_pic')->nullable();
			$table->string('amount')->nullable()->default('0');
			$table->date('dob')->nullable();
			$table->text('about')->nullable();
			$table->string('gender', 6)->nullable();
			$table->integer('status')->default(0);
			$table->bigInteger('parent_id')->nullable();
			$table->bigInteger('driver_id')->nullable();
			$table->bigInteger('vehicle_id')->nullable();
			$table->text('location')->nullable();
			$table->string('location_lat')->nullable();
			$table->string('location_long')->nullable();
			$table->integer('is_active')->default(0);
			$table->string('email_verified')->nullable();
			$table->string('mobile_verified')->nullable();
			$table->string('google_id')->nullable();
			$table->string('fb_id')->nullable();
			$table->bigInteger('address_id')->nullable();
			$table->bigInteger('ref_id')->nullable();
			$table->string('pincode', 6)->nullable();
			$table->enum('user_type', ['admin', 'driver', 'user'])->default('USER');
			$table->bigInteger('role_id')->nullable()->default(0);
			$table->rememberToken()->nullable();
			$table->longText('app_token_id')->nullable();
			$table->string('last_login_device')->nullable();
			$table->string('device_type')->nullable();
			$table->string('browser')->nullable();
			$table->string('browser_version')->nullable();
			$table->string('os')->nullable();
			$table->string('mobile_device')->nullable();
			$table->timestamp('last_login_date')->useCurrent();
			$table->text('comment')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->timestamp('created_date')->useCurrent();
			$table->bigInteger('modified_by')->nullable();
			$table->timestamp('modified_date')->useCurrent()->useCurrentOnUpdate();
			$table->index(['username', 'slug', 'email', 'mobile', 'status', 'user_type', 'role_id', 'created_by'], 'username');;
		});
	}

	/** Reverse the migrations.
	 *
	 * @return void */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
