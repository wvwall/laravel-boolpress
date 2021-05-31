@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('admin.tags.create')}}">Nuovo tag</a>
      </div>
    </div>
    <div class="row justify-content-center">
      @foreach ($tags as $tag)
        <div class="col-md-3">
            <div class="card mt-3">
                <div class="card-header">{{$tag->name}}</div>

                <div class="card-body">
                

                  <div class="">
                  <a class="btn btn-primary mt-1" href="{{route('admin.tags.show', ['tag' => $tag->id])}}">Show</a>
                    <a class="btn btn-secondary mt-1" href="{{route('admin.tags.edit', ['tag' => $tag->id])}}">Edit</a>
                    <form action="{{route('admin.tags.destroy',['tag'=>$tag->id])}}" method="post">
                        @csrf 
                        @method('DELETE')
                        <input class="delete btn btn-danger mt-1" onclick="return confirm('SEI SICURO COMPA?')" type="submit" value="DELETE">
                    </form>
                  </div>
                </div>
            </div>
        </div>
      @endforeach
      
    </div>
</div>

@endsection