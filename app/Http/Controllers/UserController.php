<?php namespace App\Http\Controllers;

use Auth;
use Request;
use Input;
use App\User;
use App\Models\UserProfile;

class UserController extends Controller {

    /**
	 * Show the application userprofile screen to the user.
	 *
	 * @return Response
	 */
	public function userProfile()
	{
		$id = Request::route('id');
		$user = User::find($id);
        
        if (Auth::check()) {
		
		    if (Auth::user()->id != $id) {
			
			    $user->userProfile->views += 1;
			    $user->userProfile->save();
		    }
		} else {
			
			$user->userProfile->views += 1;
			$user->userProfile->save();
		}
        
		return view('user_profile', ['user' => $user]);
	}

	/**
	 * Upload user's avatars.
	 *
	 * @return Void
	 */
	public function upload()
	{
		$file = Input::file('picture');
        $path = 'upload/picture';

        $id = Request::route('id');
		$userProfile = UserProfile::where('user_id', $id)->first();
		$userProfile->picture = $id;
		$userProfile->save();
        
        $filename = $id;
        $file->move($path, $filename);

        return redirect('/user/'.$id);
	}

	/**
	 * Upload user's avatars.
	 *
	 * @return Response
	 */
	public function leaders()
	{
		$userProfiles = UserProfile::orderBy('submissions', 'desc')->take(3)->get();
        
        return view('leaders', ['userProfiles' => $userProfiles]);
	}
}