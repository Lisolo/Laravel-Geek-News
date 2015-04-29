<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('url');
			$table->integer('views')->default(0)->unsigned();
			$table->integer('likes')->default(0)->unsigned();
			$table->integer('dislikes')->default(0)->unsigned();
			$table->decimal('rank', 3, 2)->default(0);
			$table->integer('submitter_id')->unsigned();
            $table->foreign('submitter_id')->references('id')->on('user');
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
		Schema::drop('blog');
	}

}
