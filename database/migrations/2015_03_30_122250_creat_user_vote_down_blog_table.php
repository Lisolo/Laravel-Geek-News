<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatUserVoteDownBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_vote_down_blog', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->integer('blog_id')->unsigned();
            $table->foreign('blog_id')->references('id')->on('blog');
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
		Schema::drop('user_vote_down_blog');
	}

}
