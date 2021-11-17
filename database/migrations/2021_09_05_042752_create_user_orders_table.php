<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('user_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->text('pickup_text')->nullable();
            $table->text('drop_text')->nullable();
            $table->string('pickup_long')->nullable();
            $table->string('pickup_lat')->nullable();
            $table->string('drop_long')->nullable();
            $table->string('drop_lat')->nullable();
            $table->string('price')->nullable();
            $table->string('kms')->nullable();
            $table->string('otp', 20)->nullable();
            $table->dateTime('booking_date')->useCurrent();
            $table->enum('type', ['normal', 'outdoor', 'upcoming'])->default('normal');
            $table->smallInteger('status')->nullable()->default(0);
            $table->string('payment_mode', 30)->nullable()->default('COD');
            $table->bigInteger('created_by')->nullable();
            $table->dateTime('created_date')->useCurrent();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}
