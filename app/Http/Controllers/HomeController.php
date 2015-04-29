<?php namespace App\Http\Controllers;

use Auth;
use Request;
use App\Models\Blog;
use App\Models\Tag;
require_once 'DateInterval.php';

class HomeController extends Controller {

    use DateInterval;

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Show the application index screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$blogs = Blog::orderBy('rank', 'desc')->paginate(7);

		if (Auth::check()) {

            foreach ($blogs as $blog) {

            	foreach ($blog->userVoteUpBlogs as $voteUp) {

            		if ($voteUp->pivot->user_id == Auth::user()->id) {

            			$blog['voteUp'] = 1;
            		}
            	}

            	foreach ($blog->userVoteDownBlogs as $voteDown) {

            		if ($voteDown->pivot->user_id == Auth::user()->id) {

            			$blog['voteDown'] = 1;
            		}
            	}

            	$blog['interval'] = $this->calculateInterval($blog['created_at']);
            }
		} 
        
		return view('home', ['blogs' => $blogs]);

	}

    /**
	 * Return the search data to user.
	 * @return json
	 */
	public function search()
	{   
		$keyword = Request::input('keyword');
		$blogs = Blog::where('title','like','%'.$keyword.'%')->get();

		foreach ($blogs as $blog) {

			unset($blog['url'], $blog['views'], $blog['likes'], 
			    $blog['dislikes'],  $blog['rank'], $blog['submitter_id'], 
			    $blog['created_at'], $blog['updated_at']);
		}

		return response()->json($blogs);
	}

    /**
	 * Record the clicks of blog.
	 *
	 * @return Response
	 */
	public function track()
	{
		$id = Request::route('id');
		$blog = Blog::find($id);
		$blog->views += 1;
		$blog->save();
        
		return redirect($blog->url);
	}

	/**
	 * Show the blogs to the user.
	 *
	 * @return Response
	 */
	public function tag()
	{
		$id = Request::route('id');
		$tag = Tag::find($id);
        
        $blog_id = array();
		foreach ($tag->blogs as $blog) {
			
			array_push($blog_id, $blog->pivot->blog_id);
		}

        $blogs = Blog::whereIn('id', $blog_id)->paginate(7);

        foreach ($blogs as $blog) {
            $blog['interval'] = $this->calculateInterval($blog['created_at']);
        }
		return view('home', ['blogs' => $blogs]);
	}

}
