<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatUsersProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profile', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('picture')->default('/picture/example');
            $table->string('website')->nullable();
            $table->integer('submissions')->default(0);
            $table->integer('views')->default(0);
            $table->integer('reputation')->default(0);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
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
		Schema::drop('user_profile');
	}

}
