<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Creates the promotions table
        Schema::create('promotions', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('order');
            $table->string('title',50);
            $table->string('image',50);
            $table->string('alias',50);
            $table->string('content',100);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promotions');
	}

}
