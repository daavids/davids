@extends('layouts.app')

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
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th></th>
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
                                <td><a href='/posts/{{$post->id}}/edit' 
                                        class='btn btn-dark float-right'>Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 
                                                    'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
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
