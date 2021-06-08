
@extends('layouts.frontend')

@section('faq')
active
@endsection

@section('content')
<div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <div class="about-wrap text-center">
                    <h3>FAQ</h3>
                  </div>
                  <div class="accordion" id="accordionExample">
                  @php
                        $flag=1;
                    @endphp
                  
                  @foreach($faqs as $faq)
                  
                    <div class="card border-0">
                      <div class="card-header border-0 p-0 my-3">
                          <button class="btn btn-link text-left py-3 {{($flag==1) ? ' ': 'collapsed'}} w-100 text-white" type="button" data-toggle="collapse" data-target="#faq{{$faq->id}}" aria-expanded="true" aria-controls="faq{{$faq->id}}">
                            {{$faq->question}}
                          </button>
                      </div>

                      <div id="faq{{$faq->id}}" class="collapse {{($flag==1) ? 'show' : ' '}}" aria-labelledby="faq{{$faq->id}}" data-parent="#accordionExample">
                        <div class="card-body">
                          {{$faq->answer}}
                        </div>
                      </div>
                    </div>
                    @php
                    $flag++;
                    @endphp
                    @endforeach


                    </div>

                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection