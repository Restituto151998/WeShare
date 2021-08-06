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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>


<script type="text/javascript" src="{{ asset('js/main.js')}}"></script>

</head>
<body style="background-color:white">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top p-4">
            <div class="container">
                <a class="navbar-brand d-flex pr-5" href="{{ url('/') }}">

                    <div><img src="/img/we.jpg" style="height: 28px; border-right: 1px solid #333" class="pr-2"> </div>
                    <div class="pl-2">WeShare</div>          
                </a>
             
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href="{{ route('profile.index' ,auth()->user()) }}"
                                       >
                                        profile
                                    </a> --}}

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
<div>
</div>

        @auth
        <div class="wrapper d-flex w-25 p-5 mt-5 justify-content-center ">
            <div class="sidebar">
                <!-- <div style="border-bottom:1px solid gray"> -->
                <ul>
                    <li><a href="#"><img src="{{Auth::user()->profile->profileImage()}}"
                                class="w-50  rounded-circle"></a></li>

               <h6 class="text-dark ml-3" style="font-size:30px"> <strong> {{ Auth::user()->name}}</strong> </h6>

                    {{-- <div class="d-flex">
                        <div class="pr-5"><strong>{{Auth::user()->profile->followers->count()}} </strong>followers</div>
                        <div class="pr-5"><strong>{{Auth::user()->following->count()}} </strong>following</div>
                    </div> --}}


                  
                    <hr>
                    <!-- </div> -->
                    <div class="container">
                            <div class="input-group">
                                    <form  action="/search" method="POST" role="search">
                                    
                                        {{ csrf_field() }}
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q"
                                                placeholder="Search Friend"> <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                 
                                      </div>
                  
                    <li><a href="{{ url('/') }} "><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="/profile/{{auth()->user()->id}}"><i class="fa fa-user"></i>Profile</a></li>

           
                </ul>
            </div>
        </div>
        @endauth
      
      

        <main class="py-4">
            <div class="col-8 pt-5 offset-3" >  @yield('offset')</div>
            <div class="col-8 pt-5" >  @yield('content')</div>
          
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
