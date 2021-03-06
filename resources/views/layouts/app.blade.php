<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('escaper') }}">{{__('Source Escaper')}}</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        @can('create', App\Crit::class)
                            <li class="nav-item">
                                <a class="nav-link" href="/crits">
                                    Crits
                                </a>
                            </li>
                        @endcan
                        @can('create', App\Group::class)
                            <li class="nav-item">
                                <a class="nav-link" href="/groups">
                                    Groups
                                </a>
                            </li>
                        @endcan
                        @can('create', App\GroupMembership::class)
                            <li class="nav-item">
                                <a class="nav-link" href="/groupmemberships">
                                    Group Memberships
                                </a>
                            </li>
                        @endcan
                        @can('create', App\Page::class)
                            <li class="nav-item">
                                <a class="nav-link" href="/pages">
                                    Pages
                                </a>
                            </li>
                        @endcan
                        @can('create', App\Paste::class)
                            <li class="nav-item">
                                <a class="nav-link" href="/pastes">
                                    Pastes
                                </a>
                            </li>
                        @endcan
                        @can('create', App\Upload::class)
                            <li class="nav-item">
                                <a class="nav-link" href="/uploads">
                                    Uploads
                                </a>
                            </li>
                        @endcan
                            @can('create', App\User::class)
                                <li class="nav-item">
                                    <a class="nav-link" href="/users">
                                        Users
                                    </a>
                                </li>
                            @endcan
                        <!-- User Block -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        @yield('content')
    </main>
</div>
<footer class="footer">
    Work In Progress - bluesoul -
    <a href="https://github.com/pxdnbluesoul/redpool">GitHub</a> - All content licensed
    <a href="https://creativecommons.org/licenses/by-sa/3.0/us/">CC-BY-SA 3.0</a> unless otherwise stated -
    REDPOOL licensed under <a href="https://opensource.org/licenses/MIT">The MIT License</a>
</footer>
</body>
</html>
