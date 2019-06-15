<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{!! csrf_token() !!}">

        <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @hasSection('pageTitle')
            <title>@yield('pageTitle') | Wilder</title>
        @else
            <title>Wilder</title>
        @endif

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container-fluid">
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('flash::message')

                    <div class="row">
                        <div class="user-nav col-3">
                            <div class="list-group">
                                <a href="/home" class="list-group-item list-group-item-action{{ request()-> segment(1) == 'home' ? ' active' : '' }}">Dashboard</a>
                                <a href="/students" class="list-group-item list-group-item-action{{ request()-> segment(1) == 'students' ? ' active' : '' }}">Students</a>
                                <a href="/entries" class="list-group-item list-group-item-action{{ request()-> segment(1) == 'entries' ? ' active' : '' }}">Activities</a>
                                <a href="/posts" class="list-group-item list-group-item-action{{ request()-> segment(1) == 'posts' ? ' active' : '' }}">Field Trips</a>
                                <a href="" class="list-group-item list-group-item-action{{ request()-> segment(1) == 'reading-lists' ? ' active' : '' }}">Reading Lists</a>
                                <a href="" class="list-group-item list-group-item-action{{ request()-> segment(1) == 'attendance' ? ' active' : '' }}">Attendance</a>
                            </div>
                        </div>

                        <div class="page-content col">
                            @yield('content')
                            {{-- <div class="card">
                                @hasSection('pageTitle')
                                    @hasSection('pageTitleButton')
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-9">@yield('pageTitle')</div>
                                                <div class="col-sm-3">@yield('pageTitleButton')</div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-header">@yield('pageTitle')</div>
                                    @endif
                                @endif
                        
                                <div class="card-body">
                                    @yield('content')
                                </div>

                            </div>
                            
                            @hasSection('cardTrailer')
                                @yield('cardTrailer')
                            @endif --}}
                        </div>
                    </div>
                </div>

            </main>
        </div>

        @hasSection('footerScripts')
            @yield('footerScripts')
        @endif

        <script src="https://kit.fontawesome.com/7f7d93cafe.js"></script>
    </body>
</html>
