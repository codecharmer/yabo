<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('user_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->text('payment_type')->nullable();
            $table->string('amount')->nullable();
            $table->enum('transaction_type', ['credit', 'debit'])->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->dateTime('created_date')->useCurrent();
            $table->text('transaction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet');
    }
}
