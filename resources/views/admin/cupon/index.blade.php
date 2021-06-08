@extends('layouts.dashboard')
@section('title')
Caupon
@endsection
@section('cupon')
active
@endsection
@section('"page-heading')
Cupon
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
                            <th scope="col">Cupon name</th>
                            <th scope="col">Discount(%)</th>
                            <th scope="col">Validity</th>
                            <th scope="col">Validity status</th>
                            <th scope="col">Expiry days</th>
                         
                            
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($cupons as $cupon)
                            <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$cupon->cupon_name}}</td>
                            <td>{{$cupon->discount}}%</td>
                            <td>{{$cupon->validity}}</td>
                            <td>
                                @if(\Carbon\Carbon::now()->format('Y-m-d') <= $cupon->validity )
                                <span class="badge text-dark bg-success">Good</span>
                                    
                                @else
                                    <span class="badge text-dark bg-danger">Bad</span>
                                @endif
                            </td>
                            <td>
                                @if(\Carbon\Carbon::now()->format('Y-m-d') < $cupon->validity )
                                <span class="badge text-dark bg-success">{{\Carbon\Carbon::parse($cupon->validity)->diffInDays(\Carbon\Carbon::now()->format('Y-m-d'))}} days left</span>
                                    
                                @elseif(\Carbon\Carbon::now()->format('Y-m-d') == $cupon->validity )
                                <span class="badge text-dark bg-primary">Last day</span>

                                @else
                                <span class="badge text-dark bg-danger">Expired {{\Carbon\Carbon::parse($cupon->validity)->diffInDays(\Carbon\Carbon::now())}} days ago</span>
                                @endif
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
                <div class="card-header"><b>Add Cupon</b></div>

                <div class="card-body">
                
                <form method="post" action="{{route('cupon.store')}}" >
                @csrf
                    <div class="form-group">
                        <label for="cupon_name">Cupon name</label>
                        <input type="text" class="form-control" id="cupon_name" ="Enter your cupon name" name="cupon_name" value="{{old('cupon_name')}}">
                       
                    </div>
                    @error('cupon_name')
                    <div class="alert alert-danger">
                    {{$message}}
                    </div>                   
                    @enderror
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount"  name="discount" value="{{old('discount')}}">
                       
                    </div>
                    @error('discount')
                    <div class="alert alert-danger">
                    {{$message}}
                    </div>                   
                    @enderror
                    <div class="form-group">
                        <label for="validity">Validity</label>
                        <input type="date" class="form-control" id="validity" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" name="validity" value="{{old('validity')}}">
                       
                    </div>
                    @error('validity')
                    <div class="alert alert-danger">
                    {{$message}}
                    </div>                   
                    @enderror

                   
                   
                    <input type="submit" value="Insert" class="btn btn-primary">
                    </form>

                        
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
