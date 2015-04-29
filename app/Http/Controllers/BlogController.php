<?php namespace App\Http\Controllers;

use Auth;
use Request;
use App\Models\Tag;
use App\Models\Blog;
use App\Http\Requests\StoreBlogPostRequest;

class BlogController extends Controller {

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	
	public function __construct()
	{
		$this->middleware('auth');
	}
    
	/**
	 * Show the application submit news screen to the user.
	 *
	 * @return Response
	 */
	public function submitNews()
	{
		return view('submit_news');
	}
    
    /**
	 * Show the application submit news screen to the user.
	 *
	 * @param  string  tags  all tags of the blog
	 *
	 * @return array
	 */
    public function handleTags($tags)
    {
        $word = '';
        $len = strlen($tags);
        $arr = array(); 

        for ($i = 0; $i < $len; $i++) {

	        if ($tags[$i] == ',') {

		        $arr[] = $word;
		        $word = '';
		        $i += 2;

	        } elseif($i == $len - 1) {

		        $word .= $tags[$i];
                $arr[] = $word;

	        } else {

		        $word .= $tags[$i];
	        }
        }

        return $arr;
    }
	/**
	 * Show the application dashboard to the user.
	 *
	 * @param  object  StoreBlogPostRequest
	 *
	 * @return Response
	 */
	public function handleBlog(StoreBlogPostRequest $request)
	{
		$blog = new Blog;
		$blog->title = Request::input('title');
		$blog->url = Request::input('url');
		$blog->user()->associate(Auth::user());

		$data = Request::input('add-tags');
		$arr = $this->handleTags($data);

		foreach ($arr as $elem) {
			
			$tag = Tag::firstOrCreate(['name' => $elem]);
			$tag->save();
			$tag->blogs()->save($blog);
		}

		return redirect('/');
	}

}