<?php namespace App\Http\Controllers;

use Auth;
use Request;
use App\User;
use App\Models\Blog;
use App\Models\Comment;

class VoteController extends Controller {

    /**
	 * Insert the vote up blog record to the database.
	 *
	 * @return json
	 */
    public function voteUpBlog()
	{
		if (Auth::check()) {

		    $id = Request::input('blog_id');
		    $blog = Blog::find($id);
		    $blog->likes += 1;
		    $blog->rank = $blog->likes * 0.35 + $blog->dislikes * 0.25 + $blog->views * 0.4;
		    $blog->save();

		    $user_id = Auth::user()->id;
		    $blog->userVoteUpBlogs()->sync([$user_id], false);
		} else {

			return response()->json(['redirect' => 1]);
		}

	}

	/**
	 * Insert the vote down blog record to the database.
	 *
	 * @return json
	 */
    public function voteDownBlog()
	{
		if (Auth::check()) {

		    $id = Request::input('blog_id');
		    $blog = Blog::find($id);
		    $blog->dislikes += 1;
		    $blog->rank = $blog->likes * 0.35 + $blog->dislikes * 0.25 + $blog->views * 0.4;
		    $blog->save();

		    $user_id = Auth::user()->id;
		    $blog->userVoteDownBlogs()->sync([$user_id], false);
		} else {

			return response()->json(['redirect' => 1]);
		}

	}

	/**
	 * Delete the vote down blog record from the database.
	 *
	 * @return void
	 */
    public function voteDownBlogCancel()
	{
		$id = Request::input('blog_id');
		$blog = Blog::find($id);
		$blog->dislikes -= 1;
		$blog->save();

		$user_id = Auth::user()->id;
		$blog->userVoteDownBlogs()->detach($user_id);

	}

	/**
	 * Delete the vote up blog record from the database.
	 *
	 * @return void
	 */
    public function voteUpBlogCancel()
	{
		$id = Request::input('blog_id');
		$blog = Blog::find($id);
		$blog->likes -= 1;
		$blog->save();

		$user_id = Auth::user()->id;
		$blog->userVoteUpBlogs()->detach($user_id);
	}

	/**
	 * SInsert the vote comment record to the database.
	 *
	 * @return json
	 */
    public function voteComment()
	{
		if (Auth::check()) {

		    $id = Request::input('comment_id');
		    $comment = Comment::find($id);
		    $comment->points += 1;
		    $comment->save();

		    $user_id = Auth::user()->id;
		    $comment->userVoteComments()->sync([$user_id], false);
		} else {

			return response()->json(['redirect' => 1]);
		}

	}

	/**
	 * Delete the vote comment record from the database.
	 *
	 * @return void
	 */
    public function voteCommentCancel()
	{
		$id = Request::input('comment_id');
		$comment = Comment::find($id);
		$comment->points -= 1;
		$comment->save();
		
		$userId = Auth::user()->id;
		$comment->userVoteComments()->detach($userId);
	}

}