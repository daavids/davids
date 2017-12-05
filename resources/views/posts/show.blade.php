@extends('layouts.app')

@section('content')
    <br>
    <a href='javascript:history.back()' class= 'btn btn-dark'>Go back</a>
    <br><br> 
    <h1>{{$post->title}}</h1>     
    <img style='width:100%' src='/storage/cover_images/{{$post->cover_image}}'>           
    <br><br>
    <div class='card card-body'>{!!$post->body!!}</div>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <br>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id],
                            'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection
