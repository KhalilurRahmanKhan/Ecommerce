<?php

namespace App\Http\Controllers;
use App\Http\Requests\changeAdminPassword;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangePasswordConfirmation;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole');

    }

    public function show()
    {
        return view('admin. editprofile');

    }

  



    public function changePassword(changeAdminPassword $request)
    {
        if($request->old_password == $request->password){
            return back()->with('Error','Old password and new password can not be same');
        }
        else{
            $old_password=$request->old_password;
            $db_password=Auth::user()->password;
            if(Hash::check($old_password,$db_password)){
                
                User::find(Auth::id())->update([
                    'password'=>Hash::make($request->password)
                ]);
                Mail::to(Auth::user()->email)->send(new ChangePasswordConfirmation());
                return back()->with('passchange','Password changed successfully');
            }
            else{
                
	        return back()->with('changeError','Old password is not right');
            }
        }
    }
}
