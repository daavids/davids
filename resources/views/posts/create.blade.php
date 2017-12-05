@extends('layouts.app')

@section('content')
    <br>
    <a href='javascript:history.back()' class= 'btn btn-dark'>Go back</a>
    <br><br> 
    <h1>Create post</h1>
    {!! Form::open(['action' => 'PostsController@store',
                    'method' => 'POST', 
                    'enctype' => 'multipart/form-data']) !!}
        <div class='form-group'>
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', 
                            ['id' => 'article-ckeditor', 
                            'class' => 'form-control', 
                            'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!} 
@endsection