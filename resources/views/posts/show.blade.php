@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{$post->title}}</h1>     
    <img style='width:100%' src='/storage/cover_images/{{$post->cover_image}}'>           
    <br><br>
    <div class='card card-body'>{!!$post->body!!}</div>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <br>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href='/posts/{{$post->id}}/edit' 
                class='btn btn-dark float-left'>
                <i class='fa fa-pencil'></i>
            </a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id],
                            'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::button('<i class=\'fa fa-trash\'></i>', 
                                ['type' => 'submit', 'class' => 'btn btn-danger ml-2'])}}
            {!!Form::close()!!}

        @endif
    @endif
@endsection
