<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Socialite;
use Auth;

class GithubController extends Controller
{
    public function redirectToGithub(){
         return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback(){
    	try {

    		$user = Socialite::driver('github')->user();
            
    		$findUser = User::where('email',$user->email)->first();
    		

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
            
    		dd($e->getMessge());
    	}
    }
}
