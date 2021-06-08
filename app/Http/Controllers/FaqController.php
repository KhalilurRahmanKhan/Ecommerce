<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Faq;
use Carbon\Carbon;
use App\Http\Requests\faqRequest;
use Auth;

class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $soft_deleted_faqs=Faq::onlyTrashed()->get();
       $faqs=Faq::all();
       return view('faq.home',compact('faqs','soft_deleted_faqs'));
    }
    public function add(faqRequest $request)
    {
      
      Faq::insert($request->except('_token')+['created_at'=>carbon::now()]);
        // Faq::insert([
        //     'question'=>$request->question,
        //     'answer'=>$request->answer,
        //     'created_at'=>Carbon::now(),
        // ]);
        return back()->withStatus('Faq is added successfully');
    }
    public function delete($id){
       Faq::find($id)->delete();
       return back()->with('DeleteStatus','Faq is deleted successfully');
    }
    public function edit($id){
       $faq=Faq::find($id);
       return view('faq.edit',[
           'faq'=>$faq,
       ]);
    }
    public function update(Request $request){
        
        Faq::find($request->id)->update([
            'question'=>$request->question,
            'answer'=>$request->answer
        ]);
        return redirect('faq/home')->with('updateStatus','Updated successfully');

    }

    public function restore($id){
        Faq::withTrashed()->where('id',$id)->restore();
        return back();
    }
    public function remove($id){
        Faq::withTrashed()->where('id',$id)->forceDelete();
        return back();
    }
}
