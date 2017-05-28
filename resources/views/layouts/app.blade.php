<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Lato'>
    <link href="/css/app.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <div class="container-logo">
            <a class="" href="{{ url('/') }}"><img class="logo center-block" src="{{URL::asset('/images/logo.svg')}}"></a>
        </div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">


                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <li><a href="{{ route('articles.index') }}">Articles</a></li>
                            <li><a href="{{ route('articleuser.index') }}">Occasions</a></li>
                            <li><a href="{{ route('contact.create') }}">Contact</a></li>
                        @else
                          <li>
                              <a href="{{ route('articles.index') }}">
                                  Articles
                              </a>

                              <form id="form" action="{{ route('articles.index') }}" method="get" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                          <li>
                              <a href="{{ route('articleuser.index') }}">
                                  Occasions
                              </a>

                              <form id="form" action="{{ route('articleuser.index') }}" method="get" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                                    <li>
                                        <a href="/messages">Messages @include('messenger.unread-count')
                                        </a>

                                        <form id="form" action="{{ route('inboxe.index') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.hisprofil') }}">
                                            Profil
                                        </a>

                                        <form id="form" action="{{ route('user.hisprofil') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact.create') }}">
                                            Contact
                                        </a>

                                        <form id="form" action="{{ route('contact.create') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    @if (Auth::user()->isAdmin)
                                        <li>
                                            <a href="{{ route('admin.index', 1) }}">
                                                Admin
                                            </a>

                                            <form id="form" action="{{ route('admin.index', 1) }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a class="" href="{{ url('/') }}"><img class="logo-footer center-block" src="{{URL::asset('/images/logo.svg')}}"></a>
            </div>
            <div class="col-md-8 footer-links">
                <ul>
                @if (Auth::guest())
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('articleuser.index') }}">Occasions</a></li>
                    <li><a href="{{ route('articles.index') }}">Articles</a></li>
                    <li><a href="{{ route('contact.create') }}">Contact</a></li>
                @else
                    <li>
                        <a href="{{ route('articles.index') }}">
                            Articles
                        </a>

                        <form id="form" action="{{ route('articles.index') }}" method="get" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                        <li>
                            <a href="{{ route('articleuser.index') }}">
                                Occasions
                            </a>

                            <form id="form" action="{{ route('articleuser.index') }}" method="get" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    <li>
                        <a href="{{ route('inboxe.index') }}">
                            Message
                        </a>

                        <form id="form" action="{{ route('inboxe.index') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                    <li>
                        <a href="{{ route('user.hisprofil') }}">
                            Profil
                        </a>

                        <form id="form" action="{{ route('user.hisprofil') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="{{ route('contact.create') }}">
                            Contact
                        </a>

                        <form id="form" action="{{ route('contact.create') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @if (Auth::user()->isAdmin)
                        <li>
                            <a href="{{ route('admin.index', 1) }}">
                                Admin
                            </a>

                            <form id="form" action="{{ route('admin.index', 1) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row row_credits">
            <div class="col-md-12">
                <h5 class="text-center credits">PERFECT KICKS - ALL RIGHTS RESERVED</h5>
            </div>
        </div>
    </div>
</footer>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
