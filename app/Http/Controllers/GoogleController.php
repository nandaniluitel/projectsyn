<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function login(){
        $data = Socialite::driver('google')->user();
        $name=$data->name;
        $email=$data->email;
        $user=User::where('email',$email)->first();
        if(!$user){
            $user=User::updateOrCreate([
                'name'=>$name,
                'email'=>$email,
                'password'=>'google123'
                ]
            );
            $user->save();
        }
        
        Auth::login($user);
        return redirect('/quiz');
    }
    
}
