<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecordsTable extends Migration {

	public function up()
	{
		Schema::create('records', function(Blueprint $table) {
			$table->increments('id');
			$table->string('record');
			$table->string('client_id');
			$table->string('user_id');
            $table->timestamps();

        });
	}

	public function down()
	{
		Schema::drop('records');
	}
}
