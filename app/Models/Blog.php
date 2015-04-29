<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'blog';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'url'];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'tag_blog', 'blog_id', 'tag_id');
    }

    public function userVoteUpBlogs()
    {
        return $this->belongsToMany('App\User', 'user_vote_up_blog', 'blog_id', 'user_id');
    }

    public function userVoteDownBlogs()
    {
        return $this->belongsToMany('App\User', 'user_vote_down_blog', 'blog_id', 'user_id');
    }

	public function user()
    {
        return $this->belongsTo('App\User', 'submitter_id');
    }

}
