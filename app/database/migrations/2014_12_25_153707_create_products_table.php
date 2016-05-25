<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the products table
        Schema::create('products', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('product_id',6);
            $table->string('title',50);
            $table->string('display_name',50);
            $table->string('category',50)->nullable();
            $table->string('image',50)->nullable();
            $table->string('alias',50);
            $table->string('content',500);
            $table->string('tag',100);
            $table->unique('product_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
