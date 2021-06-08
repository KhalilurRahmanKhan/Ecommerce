@extends('layouts.dashboard')
@section('title')
Category
@endsection
@section('category')
active
@endsection
@section('"page-heading')
Category
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-8">
     
            <div class="card">
                <div class="card-header"><b>Total category : </b></div>

                <div class="card-body">
                 

                   <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category name</th>
                            <th scope="col">Added by</th>
                            <th scope="col">Category photo</th>
                            <th scope="col">Action</th>
                         
                            
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <!-- <td>{{App\Models\User::find($category->added_by)->name}}</td> -->
                            <td>{{$category->connect_to_user_table->name}}</td>
                            <td>
                                <img width="50px" src="{{asset('uploads/category')}}/{{$category->category_photo}}" alt="{{$category->category_photo}}">
                            </td>
                            <td>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
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
                <div class="card-header"><b>Add Category</b></div>

                <div class="card-body">
                
                <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="category_name">Category name</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Enter your category name" name="category_name" value="{{old('category_name')}}">
                       
                    </div>
                    @error('category_name')
                    <div class="alert alert-danger">
                    {{$message}}
                    </div>
                    
                    @enderror

                    <div class="form-group">
                        <label for="category_photo">Category photo</label>
                        <input type="file" class="form-control" id="category_photo" name="category_photo">
                       
                    </div>
                   
                    <input type="submit" value="Insert" class="btn btn-primary">
                    </form>

                        
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
