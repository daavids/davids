<nav class='navbar navbar-dark navbar-expand-sm fixed-top'>
    <!-- Collapsed Hamburger -->
    <button class='navbar-toggler' type='button' data-toggle='collapse' 
            data-target='#app-navbar-collapse' aria-controls='app-navbar-collapse' 
            aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>

    <!-- Branding Image -->
    <a class='navbar-brand' href='{{ url('/') }}'>
        Home    
    </a>

    <div class='collapse navbar-collapse' id='app-navbar-collapse'>
        <!-- Left Side Of Navbar -->
        <ul class='navbar-nav'>
            <li class='nav-item'><a class='nav-link' href='#'>Theme</a></li>
            <li class='nav-item'><a class='nav-link' href='/posts'>Blog</a></li>
            <li class='nav-item'><a class='nav-link' href='#'>Games</a></li>
            <li class='nav-item'><a class='nav-link' href='#'>Websites</a></li>
            <li class='nav-item'><a class='nav-link' href='/laravel'>Laravel</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class='navbar-nav ml-auto'>
            <!-- Authentication Links -->
            @guest
                <li class='nav-item'><a class='nav-link' href='{{ route('login') }}'>Login</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ route('register') }}'>Register</a></li>
            @else
                <li class='nav-item dropdown'>
                    <a href='#' class='dropdown-toggle nav-link' id='navbarDropdown' data-toggle='dropdown'
                        role='button' aria-expanded='false' aria-haspopup='true'>
                        {{ Auth::user()->name }} <span class='caret'></span>
                    </a>

                    <ul class='dropdown-menu dropdown-menu-right' 
                        aria-labelledby='navbarDropdown'>
                        <a href='/dashboard' class='dropdown-item'>Dashboard</a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='{{ route('logout') }}'
                            onclick='event.preventDefault();
                                    document.getElementById('logout-form').submit();'>
                                    Logout
                        </a>
                        <form id='logout-form' action='{{ route('logout') }}' 
                                method='POST' style='display: none;'>
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
</nav>