<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/tag/{id}', 'HomeController@tag');

Route::get('/suggest-news', 'HomeController@search');

Route::get('/goto/{id}', 'HomeController@track');

Route::get('/user/{id}', 'UserController@userProfile');

Route::get('/leaders', 'UserController@leaders');

Route::post('/upload/{id}', 'UserController@upload');

Route::get('/submit-news', 'BlogController@submitNews');

Route::post('/handle-blog', 'BlogController@handleBlog');

Route::post('/handle-comment/{blog_id}', 'CommentController@handleComment');

Route::post('/handle-reply-comment/{blog_id}/{comment_id}', 'CommentController@handleReplyComment');

Route::get('/reply-comment/{blog_id}/{comment_id}', 'CommentController@replyComment');

Route::get('/news/{blog_id}/comments', 'CommentController@comments');

Route::get('/vote_up', 'VoteController@voteUpBlog');

Route::post('/vote_up_cancel', 'VoteController@voteUpBlogCancel');

Route::get('/vote_down', 'VoteController@voteDownBlog');

Route::post('/vote_down_cancel', 'VoteController@voteDownBlogCancel');

Route::get('/vote_comment', 'VoteController@voteComment');

Route::post('/vote_comment_cancel', 'VoteController@voteCommentCancel');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
