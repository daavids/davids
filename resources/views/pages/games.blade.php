@extends('layouts.app')

@section('title', 'Games')

@section('content')
    <h1 class='text-center'>{{$heading}}</h1>
     @if(count($games) > 0)
        @foreach($games as $row)
            <div class='card card-body'>
                <div class='row flex-row'>
                    <div class='col-sm-4'>
                        <img style='width:100%' src='/storage/game_images/{{strtolower($row)}}.jpg'>
                    </div>
                    <div class='col-sm-8 d-flex flex-column align-items-start'>
                        <div>
                            <h3>{{$row}}</h3>
                        </div>
                        <a class='btn btn-dark mt-auto' href='/{{strtolower($row)}}'>Play</a>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @else
        <p>No games found</p>
    @endif
@endsection