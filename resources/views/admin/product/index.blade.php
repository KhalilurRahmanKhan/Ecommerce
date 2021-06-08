@extends('layouts.dashboard')
@section('title')
Product
@endsection
@section('product')
active
@endsection
@section('"page-heading')
Product
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-8">
     
            <div class="card">
                <div class="card-header"><b>Total product : </b></div>

                <div class="card-body">
                 

                   <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Product price</th>
                            <th scope="col">Product photo</th>
                            <th scope="col">Product Multiple photo</th>
                         
                            
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>
                                <img width="50px" src="{{asset('uploads/product_thumbnails')}}/{{$product->product_thumbnail_photo}}" alt="">
                            </td>


                            <td>
                            @foreach($product->get_multiple_photos as $multiple_photo)
                                <img width="50px" src="{{asset('uploads/product_multiple_photos')}}/{{$multiple_photo->multiple_photo_name}}" alt="">
                                @endforeach
                            </td>
                           
                    
                            </tr>
                            @empty
                             <td colspan="6" class="text-center text-danger">No data available</td>
                            @endforelse
                        
                        </tbody>
                        
                        </table>
                        
                </div>



              


        </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header"><b>Add product</b></div>

                <div class="card-body">
                
                <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="category_id">Category name</label>
                    
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-Select one-</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                         
                        </select>
                       
                    </div>
                    <div class="form-group">
                        <label for="product_name">Product name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{old('product_name')}}">
                       
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" value="{{old('product_price')}}">
                       
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{old('quantity')}}">
                       
                    </div>
                    <div class="form-group">
                        <label for="product_short_description">Product short description</label>
                        <input type="text" class="form-control" id="product_short_description" name="product_short_description" value="{{old('product_short_description')}}">
                       
                    </div>
                    <div class="form-group">
                        <label for="product_long_description">Product long description</label>
                        <textarea name="product_long_description" class="form-control" id="product_long_description"  >{{old('product_long_description')}}</textarea>
                       
                    </div>
                    
                

                    <div class="form-group">
                        <label for="product_thumbnail_photo">Product thumbnail photo</label>
                        <input type="file" class="form-control" id="product_thumbnail_photo" name="product_thumbnail_photo">
                       
                    </div>
                

                    <div class="form-group">
                        <label for="product_multiple_photos">Product multiple photos</label>
                        <input type="file" class="form-control" id="product_multiple_photos" name="product_multiple_photos[]" multiple>
                       
                    </div>
                   
                    <input type="submit" value="Insert" class="btn btn-primary">
                    </form>

                        
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
