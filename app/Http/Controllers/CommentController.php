<?php namespace App\Http\Controllers;

use Auth;
use Request;
use App\Models\Comment;
use App\Http\Requests\StoreCommentPostRequest;

require_once 'DateInterval.php';

class CommentController extends Controller {

    use DateInterval;
    /**
     * Insert a new comment to the database.
     *
     * @param StoreCommentPostRequest $request
     * @return Response
     * @internal param $StoreCommentPostRequest
     *
     */
    public function handleComment(StoreCommentPostRequest $request)
    {
        $comment = new Comment;
        $comment->content = Request::input('content');
        $comment->user_id = Auth::user()->id;

        $blog_id = Request::route('blog_id');
        $comment->blog_id = $blog_id;
    
        $comment->save();
        
        return redirect('/news/'.$blog_id.'/comments');
    }
    

    /**
     * Insert a new reply comment to the database.
     *
     * @param  object  StoreCommentPostRequest
     *
     * @return Response
     */
    public function handleReplyComment(StoreCommentPostRequest $request)
    {
        
        $comment = new Comment;
        $comment->content = Request::input('content');
        $comment->user_id = Auth::user()->id;

        $blog_id = Request::route('blog_id');
        $comment->blog_id = $blog_id;
        
        $commentId = Request::route('comment_id');
        $comment->reply_comment_id = $commentId;

        $comment->save();

        return redirect('/news/'.$blog_id.'/comments');
    }

    /**
     * Show the application comments screen to the user.
     *
     * @return Response
     */
    public function comments()
    {
        $blog_id = Request::route('blog_id');
        $comments = Comment::where('blog_id', $blog_id)->orderBy('points', 'desc')->get();

        if (Auth::check()) {

            foreach ($comments as $comment) {

                foreach ($comment->userVoteComments as $voteUp) {

                    if ($voteUp->pivot->user_id == Auth::user()->id) {
                        
                        $comment['vote'] = 1;
                    }
                }

                $comment['interval'] = $this->calculateInterval($comment['created_at']);
            }
        }
        return view('comments', ['comments' => $comments, 'id' => $blog_id]);
    }

    /**
     * Show the application reply comments screen to the user.
     *
     * @return Response
     */
    public function replyComment()
    {
        if (Auth::check()) {

            $blog_id = Request::route('blog_id');
            $comment_id = Request::route('comment_id');
            $comment = Comment::find($comment_id);
            $comment['interval'] = $this->calculateInterval($comment['created_at']);

            return view('reply_comment', ['blog_id' => $blog_id, 'comment' => $comment]);
        }
        else {

            return redirect('/auth/login');
        }

    }

}