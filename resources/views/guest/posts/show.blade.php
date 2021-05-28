@extends('layouts.app')


@section('content')
<div class="container">
    
    <div class="row justify-content-center">
      
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><h3>{{$post->title}}</h3>
                <h4>Category: <a href="{{route('category.index',['slug' => $post->category->slug])}}">{{ $post->category->name}}</a></h4></div>

                <div class="card-body">
                  {{$post->content}}

                  <div class="">
                  
                  </div>
                </div>
            </div>
        </div>
      
    </div>
</div>

@endsection