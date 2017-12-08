@extends('layouts.app')

@section('title', $post->title. ' - edit')

@section('content')
    <br>
    <a href='javascript:history.back()' class= 'btn btn-dark'>Go back</a>
    <br><br> 
    <h1>Edit post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 
                    'method' => 'POST', 
                    'enctype' => 'multipart/form-data']) !!}
        <div class='form-group'>
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection