<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'tag';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'views'];

	public function blogs()
    {
        return $this->belongsToMany('App\Models\Blog', 'tag_blog', 'tag_id', 'blog_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_like_tag', 'user_id', 'tag_id');
    }

}
