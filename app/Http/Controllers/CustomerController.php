<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole');
    }

    public function home(){
        return view('customer.home');
    }
}
