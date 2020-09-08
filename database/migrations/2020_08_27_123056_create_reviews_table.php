<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->enum('review', array('1', '2', '3', '4', '5'));
			$table->integer('client_id');
			$table->string('comment');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}
