<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use App\Models\User;
use Auth;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();

    }
    public function callback(){
        $user = Socialite::driver('google')->user();

        if(!User::where('email',$user->getEmail())->where('name','$user->getName()')->exists()){
            User::insert([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('123'),
                'role'=>2,
                'created_at'=>Carbon::now(),
            ]);
        }
    
     
    
        if (Auth::attempt(['email' => $user->getEmail(), 'password' => '123'])) {
            
            return redirect('customer/home');
        }

    }
}
