@extends('layouts.app')


@section('content')
<div class="container">
    
    <div class="row justify-content-center">
      
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{$post->title}}</div>

                <div class="card-body">
                  {{$post->content}}

                  <div class="">
                  <a href="{{route('posts.index')}}">Torna Indietro</a>
                  </div>
                </div>
            </div>
        </div>
      
    </div>
</div>

@endsection