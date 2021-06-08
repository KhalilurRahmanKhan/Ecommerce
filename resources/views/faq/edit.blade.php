@extends('layouts.dashboard')

@section('title')
Edit Faq
@endsection
@section('profile')
active
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('faq/home')}}">Add Faq</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$faq->question}}</li>
            </ol>
        </nav>
        <div class="card">
                <div class="card-header"><b>Edit Faq</b></div>

                <div class="card-body">
                
                <form method="post" action="{{url('faq/update')}}">
                @csrf
                     <input type="hidden" name="id" value="{{$faq->id}}"> 
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" placeholder="Enter your question" name="question" value="{{$faq->question}}">
                        
                    </div>
                   
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea class="form-control" id="answer" rows="3" placeholder="Enter your answer" name="answer">{{$faq->answer}}</textarea>
                      
                    </div>
                    <input type="submit" value="Insert" class="btn btn-primary">
                    </form>

                        
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
