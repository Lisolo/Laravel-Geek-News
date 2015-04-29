<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('content');
			$table->integer('points')->default(0);
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->integer('blog_id')->unsigned();
            $table->foreign('blog_id')->references('id')->on('blog');
            $table->integer('reply_comment_id')->unsigned()->nullable();
            $table->foreign('reply_comment_id')->references('id')->on('comment');
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
		Schema::drop('comment');
	}

}
