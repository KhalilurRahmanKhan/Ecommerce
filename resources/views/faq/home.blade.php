@extends('layouts.dashboard')
@section('title')
Faq
@endsection
@section('faq')
active
@endsection
@section('"page-heading')
Faq
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('DeleteStatus'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('DeleteStatus') }}
                        </div>
                    @endif
                    @if (session('updateStatus'))
                        <div class="alert alert-info" role="alert">
                            {{ session('updateStatus') }}
                        </div>
                    @endif
        <div class="col-8">
     
            <div class="card">
                <div class="card-header"><b>Total Faq : </b>{{ $faqs->count() }}</div>

                <div class="card-body">
                 

                   <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Created at</th>
                            
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faqs as $faq)
                            <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$faq->question}}</td>
                            <td>{{$faq->answer}}</td>
                            <td>
                             @if(isset($faq->created_at))
                             {{ $faq->created_at->format('d/m/Y')}}
                             @else
                             {{'-'}}
                             @endif
                            </td>
                         
                            <td style="width:25%;">
                             <a class="btn btn-sm btn-info " href="{{url('faq/edit')}}/{{$faq->id}}">Edit</a>
                             <a class="btn btn-sm btn-danger " href="{{url('faq/delete')}}/{{$faq->id}}">Delete</a>
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
                <div class="card-header"><b>Add Faq</b></div>

                <div class="card-body">
                
                <form method="post" action="{{url('faq/add')}}">
                @csrf
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" placeholder="Enter your question" name="question" value="{{old('question')}}">
                        @error('question')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea class="form-control" id="answer" rows="3" placeholder="Enter your answer" name="answer">{{old('answer')}}</textarea>
                        @error('answer')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <input type="submit" value="Insert" class="btn btn-primary">
                    </form>

                        
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
 <div class="row">
 <div class="col-8">
 <div>  
            <div class="card ">
                <div class="card-header"><b>Soft deleted Faqs : </b>{{ $soft_deleted_faqs->count() }}</div>

                <div class="card-body">
                 

                   <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                            
                            <th scope="col">Deleted at</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($soft_deleted_faqs as $faq)
                            <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$faq->question}}</td>
                            <td>{{$faq->answer}}</td>
                         
                         
                         
                            <td>
                             @if(isset($faq->deleted_at))
                             {{ $faq->deleted_at->diffForHumans()}}
                             @else
                             {{'-'}}
                             @endif
                            </td>
                            <td style="width:30%;">
                             <a class="btn btn-sm btn-success" href="{{url('faq/restore')}}/{{$faq->id}}">Restore</a>
                             <a class="btn btn-sm btn-danger" href="{{url('faq/remove')}}/{{$faq->id}}">Remove</a>
                            </td>
                            </tr>
                            @empty
                             <td colspan="7" class="text-center text-danger">No data available</td>
                            @endforelse
                       
                        </tbody>
                        
                        </table>
                        
                </div>
            </div>
            </div>
 </div>
 </div>
</div>
@endsection
