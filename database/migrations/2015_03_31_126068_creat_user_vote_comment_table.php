<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatUserVoteCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_vote_comment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->integer('comment_id')->unsigned();
            $table->foreign('comment_id')->references('id')->on('comment');
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
	    Schema::drop('user_vote_comment');
	}

}