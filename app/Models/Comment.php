<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comment';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['points'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

	public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }
    
    public function comment()
    {
        return $this->belongsTo('App\Models\Comment', 'reply_comment_id');
    }

    public function userVoteComments()
    {
        return $this->belongsToMany('App\User', 'user_vote_comment', 'comment_id', 'user_id');
    }

}
