<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $categories=Category::all();
        return view('admin.category.addcategory',[
            'categories'=>Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'category_name'=>'required|unique:categories,category_name'
        ]);
        $category_info=Category::create([
            'category_name'=>$request->category_name,
            'added_by'=>Auth::id(),
            'created_at'=>carbon::now(),
        ]);
       
         
        if($request->hasFile('category_photo')){
            $uploaded_photo=$request->file('category_photo');
            $uploaded_photo_name=$category_info->id.".".$uploaded_photo->extension();
            $location=base_path('public/uploads/category/'.$uploaded_photo_name);
            Image::make($uploaded_photo)->resize(600,470)->save($location,50);
            $category_info->category_photo=$uploaded_photo_name;
            $category_info->save();
            // Category::find($category_info->id)->update([
            //     'category_photo'=>$uploaded_photo_name,
            // ]);
        }
        
    
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if($request->hasFile('category_photo')){
            if($category->category_photo != 'default_category.jpg'){
                $location=base_path('public/uploads/category/'.$category->category_photo);
                unlink($location);
            }

                $uploaded_photo=$request->file('category_photo');
                $uploaded_photo_name=$category->id.".".$uploaded_photo->extension();
                $location=base_path('public/uploads/category/'.$uploaded_photo_name);
                Image::make($uploaded_photo)->resize(600,470)->save($location,50);
                $category->category_photo=$uploaded_photo_name;
           
        }
       
       $category->category_name=$request->category_name;
       $category->save();

       return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
