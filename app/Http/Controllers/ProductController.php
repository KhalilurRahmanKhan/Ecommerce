<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product_multiple_photo;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('verified')->except(['show']);
        $this->middleware('checkrole');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index',[
            'categories'=>Category::all(),
            'products'=>Product::all(),
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
        $product_slug=Str::slug($request->product_name.'-'.Carbon::now()->timestamp);
        $product_id=Product::insertGetId([
            'category_id'=>$request->category_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'quantity'=>$request->quantity,
            'product_short_description'=>$request->product_short_description,
            'product_long_description'=>$request->product_long_description,
            'product_thumbnail_photo'=>'',
            'product_slug'=>$product_slug,
            'created_at'=>Carbon::now(),
        ]);
        $uploaded_photo=$request->file('product_thumbnail_photo');
        $uploaded_photo_name=$product_id.".".$uploaded_photo->extension();
        $location=base_path('public/uploads/product_thumbnails/'.$uploaded_photo_name);
        Image::make($uploaded_photo)->resize(600,622)->save($location,50);
        
        Product::find($product_id)->update([
            'product_thumbnail_photo'=>$uploaded_photo_name,
        ]);  

        $all_images=$request->file('product_multiple_photos');
        $flag=1;
        foreach($all_images as $single_image){
            $uploaded_photo_name=$product_id."-".$flag.".".$single_image->extension();
            $location=base_path('public/uploads/product_multiple_photos/'.$uploaded_photo_name);
            Image::make($single_image)->resize(600,550)->save($location,50);

            Product_multiple_photo::insert([
                'product_id'=>$product_id,
                'multiple_photo_name'=>$uploaded_photo_name,
                'created_at'=>Carbon::now(),
            ]);
            $flag++;
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product_info=Product::where('product_slug',$slug)->first();
        $related_products=Product::where('category_id',$product_info->category_id)->where('id','!=',$product_info->id)->get();
     

        return view('frontend.product_details',compact('product_info','related_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
