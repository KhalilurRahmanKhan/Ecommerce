<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index(){
        

        return view('frontend.index',[
            'products'=>  Product::orderBy('id','desc')->get(), 
            'categories'=>  Category::all(), 
        ]);
    }
    public function about(){
        

        return view('frontend.about');
    }
    public function contact(){
        

        return view('frontend.contact');
    }
    public function faq(){
        
        
        return view('frontend.faq',[
            'faqs'=>Faq::all()
        ]);
    }
}
