<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Creates the categories table
        Schema::create('categories', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('title',50);
            $table->string('parent',50)->nullable();
            $table->string('image',50)->nullable();
            $table->string('alias',50);
            $table->string('description',100);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
