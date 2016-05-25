<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::create('categories', function($table) {
        	$table->increments('id');
        	$table->string('name',20)->unique();
        	$table->string('description',50)->unique()->nullable();
        	$table->integer('category_id')->unsigned();
        	$table->foreign('category_id')->references('id')->on('categories');
        	$table->string('image',50);
        	$table->timestamps();
        });

        Schema::create('products', function($table) {
        	$table->increments('id');
        	$table->string('name',20)->unique();
        	$table->string('description',50)->unique()->nullable();
        	$table->integer('category_id')->unsigned();
        	$table->foreign('category_id')->references('id')->on('categories');
        	$table->string('property',20)->nullable();
        	$table->string('image',50);
        	$table->string('price',20)->nullable();
        	$table->string('content',100)->nullable();
        	$table->boolean('feature')->default(false);
        	$table->boolean('promotion')->default(false);
        	$table->timestamps();
        });

        Schema::create('images', function($table) {
        	$table->increments('id');
        	$table->string('name',20)->unique();
        	$table->string('path',50)->unique();
        	$table->integer('product_id')->unsigned();
        	$table->foreign('product_id')->references('id')->on('products');
        	$table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
