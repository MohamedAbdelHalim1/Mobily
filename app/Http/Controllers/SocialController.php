<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;  //Socialite facade takes care of redirecting the user to the OAuth provider
use Exception;
use Auth;
use Hash;
use Str;

class SocialController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callback(){
     
    try{
            $user = Socialite::driver('facebook')->stateless()->user();  //get data from provider
           // dd($user); //this will return object carry all data of this user returned from provider which is facebook
           //if user doesnot exist we need to create him,but if they do then get the model either way authenticate user
           //and redirect him afterward

           //dd($user);
           $user = User::firstOrcreate([
            //first parameter is an array value that we used to find a user,we use email cuz its only unique column for table
            'email' => $user->email,  //as if you are in login phase and check if email is matching, and $user-> is coming from provider
           ],  //second parameter if user doesnot exist we will create
           [
            'name'=> $user->name,
            'email'=>$user->email,
            'password'=> Hash::make(Str::random(24)),
           ]);
     
            
             Auth::login($user);
             return redirect('/');
            
        }catch(Exception $e){
            return $e;
        }
    
    }
}
