<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
    	try {

    		$user = Socialite::driver('google')->user();

    		$finduser = User::where('email',$user->email)->first();

    	if ($finduser) {
    			Auth::login($finduser);
    			return redirect('admin/home');
    		} else {
    			$newUser = User::create([

                     'name'      => $user->name,
                     'email'     => $user->email,
                     'provider_id' => $user->id,
                     'avatar' => $user->avatar,
                     'password'  => encrypt('12345678')
    			]);
    			Auth::login($newUser);
    			return redirect('admin/home');
    		}
    			
    		
    	} catch (Exception $e) {
    		dd($e->getMessage());
    	}
    }
}
