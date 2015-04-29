<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {
    
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_profile';
    
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['picture', 'website', 'submissions', 'views', 'reputation'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

}
