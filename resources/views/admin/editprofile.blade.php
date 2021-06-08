@extends('layouts.dashboard')
@section('title')
Change password
@endsection
@section('profile')
active
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-8">
        
        @if(session('passchange'))
            <div class="alert alert-success">
                {{session('passchange')}}  
             </div>
        @endif
  
     
        <div class="card">
                <div class="card-header"><b>Change password</b></div>

                <div class="card-body">
                
                <form method="post" action="{{url('changepassword')}}">
                @csrf
                    <div class="form-group">
                        <label for="old_password">Old password</label>
                        <input type="password" class="form-control" id="old_password" placeholder="Enter your old password" name="old_password">
                        
                    </div>
                      @error('old_password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        @if(Session::has('changeError'))

                            <div class="alert alert-danger">

                                {{Session::get('changeError')}}

                            </div>

                              @endif
                        
                    <div class="form-group">
                        <label for="password">New password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your new password" name="password">
                        
                    </div>
                  
                     @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        @if(Session::has('Error'))

                            <div class="alert alert-danger">

                                {{Session::get('Error')}}

                            </div>

                            @endif
                     
                   
                       
                    <div class="form-group">
                        <label for="c_password">Confirm password</label>
                        <input type="password" class="form-control" id="c_password" placeholder="Enter your password again" name="password_confirmation">
                        
                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <br>
                   
                    
                    <input type="submit" value="Change" class="btn btn-primary">
                    </form>
    

                        
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
