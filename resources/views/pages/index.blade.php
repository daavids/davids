@extends("layouts.app")

@section("title", "Index")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="text-center heading">
            <h1>{{$heading}}</h1>
            <h2>Full-stack developer located in Latvia</h2>
            <a class='btn btn-success' data-scroll href='#projects'>Projects</a>
            <a class="btn btn-success" data-scroll href="#contact">Contact</a>
            <a class="btn btn-success" href="https://github.com/mrtehnuke/">Github</a> 
        </div>
        <h3>About this site:</h3>
        <ul>
            <li>
                This site is where I will post any side-projects I might make or
                any projects that I am allowed to present.
            </li>
            <li>
                It"s built on the <a href="/laravel">Laravel</a> framework.
            </li>
            <li>The <a href="/posts">blog</a> section is only there as I made it for learning purposes, but you can create posts,
                if you want, though you need to <a href="/register">register</a> first.
            </li>
            <li>
                The <a href="/games">games</a> section currently has only two games: <a href="/minesweeper">Minesweeper</a> and 
                <a href="/tic-tac-toe">Tic-Tac-Toe</a>. I"m not currently planning on adding more feature for the existing games
                 (like score keeping for users) or adding more games in general, atleast in the near future.
            </li>
        </ul>
    </div>
</div>

@if(count($skills))
<div class="row skills">
    <div class="col-12">
        <h3>Language and technology skills:</h3> 
        <ul class="list-group">
            @foreach($skills as $row)
                <li class="list-group-item">{{$row}}</li>
            @endforeach
        </ul>     
    </div>
</div>
@endif

@if(count($projects))
<div class="row projects" id="projects">
    <div class="col-12">
        <h3>Projects and experience:</h3>
            @foreach($projects as $row)
            <div class="card card-body">
                <div class="row flex-row">
                    <div class="col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{strtolower($row->image)}}.png">
                    </div>
                    <div class="col-sm-8 d-flex flex-column align-items-start">
                        <h3>{{$row->title}}</h3>
                        <p>{{$row->body}}</p>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
@endif        

<div class="row contact" id="contact">
    <div class="col-12">
        <h3>E-mail me at davidsgabalins&commat;gmail.com or leave a message below:</h3>
        {!! Form::open(['action' => 'MessagesController@store',
                        'method' => 'POST', 
                        'enctype' => 'multipart/form-data']) !!}
            <div class='form-group'>
                {{Form::label('name', 'Your name')}}
                {{Form::text('name', '', ['class' => 'form-control', 
                                          'placeholder' => 'Enter your name here'])}}
            </div>
            <div class='form-group'>
                {{Form::label('email', 'Your e-mail')}}
                {{Form::text('email', '', ['class' => 'form-control', 
                                            'placeholder' => 'Enter your e-mail here'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Your message')}}
                {{Form::textarea('body', '', 
                                ['id' => 'article-ckeditor', 
                                'class' => 'form-control', 
                                'placeholder' => 'Enter your message here'])}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
        {!! Form::close() !!}
    </div>
</div>

@endsection