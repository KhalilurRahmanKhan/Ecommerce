@extends('layouts.dashboard')
@section('title')
Edit category
@endsection
@section('category')
active
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-8">
        
  
     
        <div class="card">
                <div class="card-header"><b>Update category</b></div>

                <div class="card-body">
                
                <form method="post" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <div class="form-group">
                        <label for="category_name">Category name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category->category_name}}">
                        
                    </div>
               
                        
                    <div class="form-group">
                        <label for="category_photo">Category photo</label>
                        <input type="file" class="form-control" id="category_photo" name="category_photo">
                        
                    </div>
               
                    
                    
                    <input type="submit" value="Update" class="btn btn-primary">
                    </form>
    

                        
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
