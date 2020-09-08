<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('user_id');
			$table->string('message');
			$table->tinyInteger('type');
			$table->text('message_reply');
			$table->tinyInteger('is_read');
            $table->timestamps();

        });
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}
