<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(Auth::user())
        <meta name="user-id" content="{{ Auth::user()->id }}">
        <meta name="user-name" content="{{ Auth::user()->name}}">
        <meta name="user-avatar-thumb-url" content="{{ Auth::user()->user_avatar_thumb_url }}">
    @endif
    <link rel="icon" href="{{ URL::to('/favicon.ico')}}" type="image/x-icon">
    {!! SEO::generate(true) !!}
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @if (App::environment('production'))
        @include('include.analytics')
        <script data-ad-client="ca-pub-9752617241777308" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    @endif
</head>
<body>
<!-- Styles -->
<link href="{{ mix('/css/admin.css') }}" rel="stylesheet">
<link href="{{ asset('css/metravel.css') }}" rel="stylesheet">
<!-- Fonts -->
<link   href="https://fonts.googleapis.com/css2?family=Jost:wght@100&display=swap" rel="stylesheet">
<link   href="https://fonts.googleapis.com/css2?family=Bad+Script&display=swap" rel="stylesheet">
@include('cookieConsent::index')
<div id="app">

    <nav class="navbar bg-white navbar-expand-md navbar-light shadow-sm zindex2">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Me Travel') }}
                <img class="logoimg" src="/media/slider/logo_yellow.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <a class="nav-link" href="{{ url('travels') }}">
                        {{ trans('main.alltravel') }}
                    </a>
                    <a class="nav-link" href="{{ url('travelsby') }}">
                        {{ trans('main.beltravel') }}
                    </a>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-orange" href="{{ url('travels/create') }}">
                                {{ trans('home.addTravels') }} <span class="caret"></span>
                            </a>
                        </li>

                    @endauth
                <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                {{ trans('home.login') }}
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ trans('home.register') }}
                                </a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(Auth::user()->user_avatar_thumb_url)
                                    <img src="{{ Auth::user()->user_avatar_thumb_url }}" class="avatar-photo">
                                @endif
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">
                                    {{ trans('home.editProfile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('users.allMessages', Auth::user()) }}">
                                    {{ trans('home.allMessages') }}
                                    @if(Auth::user()->unreadMessagesCount()>0)
                                        <span class="badge badge-secondary">
                                    {{ Auth::user()->unreadMessagesCount() }}
                                </span>
                                    @endif
                                </a>

                                <a class="dropdown-item" href="{{ url('travels/metravel') }}">
                                    {{ trans('home.meTravels') }} <span class="caret"></span>
                                </a>

                                <a class="dropdown-item" href="{{ route('users.allFriends', Auth::user()) }}">
                                    {{ trans('home.allFriends') }}
                                    @if(Auth::user()->accepted_friends_count>0)
                                        <span class="badge badge-secondary">
                                    {{ Auth::user()->accepted_friends_count }}
                                </span>
                                    @endif
                                </a>

                                <a class="dropdown-item" href="{{ url('travels/friendtravel') }}">
                                    {{ trans('home.follower') }} <span class="caret"></span>
                                </a>


                                <a class="dropdown-item" href="{{ url('travels/favoriteTravel') }}">
                                    {{ trans('home.saveTravel') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ trans('home.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>

                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @yield('footer')
</div>
</body>

@include('brackets/admin-ui::admin.partials.wysiwyg-svgs')
@include('brackets/admin-ui::admin.partials.main-bottom-scripts')
@yield('bottom-scripts')
</html>
