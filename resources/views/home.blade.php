@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class='row mt-5'>
    <div class='col-md-8 offset-md-2'>
        <div class='card'>
            <div class='card-header'>Dashboard</div>

            <div class='card-body'>
                <a href='/posts/create' class='btn btn-dark'>Create Post</a>
                <br>
                <br>
                <h3>Your Blog Posts</h3>
                @if(count($posts) > 0)
                    <table class='table table-hover dashTable'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($posts as $post)
                        <tbody>
                            <tr>
                                <td class='align-middle'>
                                    <a href='/posts/{{$post->id}}' class='dashPostLink'>
                                        <strong>{{$post->title}}</strong>
                                    </a>
                                </td>
                                <td>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 
                                                    'method' => 'POST', 'class' => 'float-right ml-2'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::button('<i class=\'fa fa-trash\'></i>', 
                                                        ['type' => 'submit', 'class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}

                                    <a href='/posts/{{$post->id}}/edit' 
                                        class='btn btn-dark float-right ml-5'>
                                        <i class='fa fa-pencil' aria-hidden='true'></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                @else
                    <p>You have no posts</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
