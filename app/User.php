<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function userProfile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }
    
    public function voteUpBlogs()
    {
        return $this->belongsToMany('App\Models\Blog', 'user_vote_up_blogs', 'user_id', 'blog_id');
    }

    public function voteDownBlogs()
    {
        return $this->belongsToMany('App\Models\Blog', 'user_vote_down_blogs', 'user_id', 'blog_id');
    }

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog', 'submitter_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    public function voteComments()
    {
        return $this->belongsToMany('App\Models\User', 'user_vote_comments', 'user_id', 'comment_id');
    }

    public function likeTags()
    {
        return $this->belongsToMany('App\Models\Tag', 'user_like_tag', 'user_id', 'tag_id');
    }

}
