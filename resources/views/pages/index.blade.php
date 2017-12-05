@extends('layouts.app')

@section('content')
        <h1>{{$title}}</h1>
        <br>
        @if(count($technologies) > 0)
            <h3>Languages:</h3> 
        	<ul class="list-group">
           	    @foreach($technologies as $row)
                	<li class="list-group-item">{{$row}}</li>
                @endforeach
        	</ul> 
            <br>
        @endif
        @if(count($todo) > 0)
            <h3>To-do:</h3>
            <ul class="list-group">
                @foreach($todo as $row)
                    <li class="list-group-item">{{$row}}</li>
                @endforeach
            </ul>
            <br>
        @endif
        @if(count($done) > 0)
            <h3>Done:</h3>
            <ul class="list-group">
                @foreach($done as $row)
                    <li class="list-group-item">{{$row}}</li>
                @endforeach
            </ul>
            <br>
        @endif
@endsection