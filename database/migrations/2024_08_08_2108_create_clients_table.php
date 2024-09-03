<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->date('d_o_b');
			$table->date('last_donation_date');
			$table->integer('blood_type_id');
			$table->integer('city_id');
			$table->integer('governorate_id');
			$table->integer('pin_code');
			$table->string('api_token');
			$table->dateTime('pin_code_expires_at');
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
