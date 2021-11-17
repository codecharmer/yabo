<?php

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('category_id')->nullable();
            $table->text('image')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('seats')->nullable();
            $table->string('toll_charges')->nullable();
            $table->integer('price')->nullable();
            $table->string('manufacture_year')->nullable();
            $table->boolean('status')->nullable()->default(0);
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
        Schema::dropIfExists('vehicles');
    }
}
