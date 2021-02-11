<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-css.css') }}">

</head>
<body>
<div id="app">
    <nav class="row navbar navbar-expand-md navbar-dark bg-dark">
        <div class="col-4">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <div class="col-2 offset-1">
            <a class="navbar-brand" href="/">BookStore.lt</a>
        </div>

        <div class="col-3 offset-2  text-white">
            <div class="row">
            @guest
                @if (Route::has('login'))
                    <a class="nav-link text-success" href="{{ url('/login') }}">Login <span class="sr-only">(current)</span></a>
                @endif
                @if (Route::has('register'))
                    <a class="nav-link text-success" href="{{ route('register') }}">Register <span class="sr-only">(current)</span></a>
                @endif
            @else

                    <a href="{{ route('booksManageMenu') }}" class="nav-link text-success">
                        Manage books
                    </a>
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu  aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">
                                Admin area
                            </a>
                            <a class="dropdown-item" href="#">
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
</nav>

<main class="py-4">
    @yield('content')
</main>
</div>
</body>
</html>
