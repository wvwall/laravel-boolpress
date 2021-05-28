@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
      
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><h3>{{$post->title}}</h3> <h4>Category: <a href="">{{ $post->category->name}}</a></h4></div>

                <div class="card-body">
                  {{$post->content}}

                  <div class="">
                    <a class="btn btn-secondary" href="{{route('admin.posts.edit', ['post' => $post->id])}}">Edit</a>
                    <form action="{{route('admin.posts.destroy',['post'=>$post->id])}}" method="post">
                        @csrf 
                        @method('DELETE')
                        <input class="delete btn btn-danger" onclick="return confirm('SEI SICURO COMPA?')" type="submit" value="DELETE">
                    </form>
                  </div>
                </div>
            </div>
        </div>
      
    </div>
</div>

@endsection