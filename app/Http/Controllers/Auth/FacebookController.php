<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Socialite;
use Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook(){
         return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        try {
        	$user = Socialite::driver('facebook')->user();
        	//dd($user);
        	$findUser = User::where('email',$use->email)->first();
            //dd($findUser);
          if ($findUser) {
    	 		Auth::login($findUser);
    	 	  return redirect('admin/home');
    	 	} else {
    	 		$newUser = User::create([
                   
                      'name' => $user->name,
                      'email' => $user->email,
                      'provider_id' => $user->id,
                      'avatar' => $user->avatar,
                      'password' => encrypt('12345678'),
    	 		]);
    	 		Auth::login($newUser);
    	 	  return redirect('admin/home');
    	 	}
          
        } catch (Exception $e) {
        	dd($e->getMessage());
        }
    }
}
