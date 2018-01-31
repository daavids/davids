<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dāvids | @yield('title')</title>
    <meta name='description' content='My personal website'>
    <meta name='author' content='Dāvids Gabaliņš'
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('inc.navbar')
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    if(document.getElementById('article-ckeditor')) {
        CKEDITOR.replace( 'article-ckeditor' );
    }
</script>
<script>
    let scroll = new SmoothScroll();

    let scrollWithoutUrlChange = (selector, settings) => {

        let clickHandler = (event) => {

            let toggle = event.target.closest(selector);
            if (!toggle || toggle.tagName.toLowerCase() !== 'a') { return; }
            let anchor = document.querySelector(toggle.hash);
            if (!anchor) { return; }

            event.preventDefault();
            scroll.animateScroll(anchor, toggle, settings || {});
        };
        window.addEventListener('click', clickHandler, false);
    };

    scrollWithoutUrlChange('a[href*="#"]', {
        offset: 70
    });
</script>
</body>
</html>
