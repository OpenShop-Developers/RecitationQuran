<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->enum('gender', array('male', 'female'));
            $table->string('api_token')->unique();
            $table->string('pin_code')->nullable();
            $table->timestamps();

        });
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
