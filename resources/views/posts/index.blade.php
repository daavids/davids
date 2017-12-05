@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $row)
            <div class="card card-body">
                <div class="row">
                    <div class='col-sm-4'>
                        <img style='width:100%' src='/storage/cover_images/{{$row->cover_image}}'>
                    </div>
                    <div class='col-sm-8'>
                        <h3><a href="/posts/{{$row->id}}">{{$row->title}}</a></h3>
                        <small>Written on {{$row->created_at}} by {{$row->user->name}}</small>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection
