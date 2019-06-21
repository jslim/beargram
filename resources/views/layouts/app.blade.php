<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BearGram') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex"  href="{{ url('/') }}">

                   <div><img src="/png/bearGram.png" style="height: 40px; border-right: 1px solid #904F41;" class="pr-3"></div> 
                   <div class="pl-3 pr-4 pt-1" > BearGram </div>

                </a>
                    <!--MOST RECENT POST AND FOLLOWING POSTS-->
                <div class="col-8 pl-6 pt-2">

                   <div>
                    <img src="/png/bearGram.png" style="height: 20px; " class="pr-3"> 
                    <a href="/recent">Most Recent Posts</a>  

                    </div>


                   <div>
                   <img src="/png/bearGram.png" style="height: 20px; " class="pr-3">
                    <a href="/">Following Paws</a>  
                    </div>
                   
                </div> 


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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        
                         <a href="/profile/{{ Auth::user()->id }}" class="pr-2 pt-2">
                              <div class="">  {{ Auth::user()->username }} </div>

                        </a>
                            

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="glyphicon glyphicon-cog">Config</span>
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
        
        <!--FOOTER-->

        <footer>
            <hr>
        <center><h5>© Copyright 2019 - José Delgado</h5></center> 
            <br>
        <div class="d-flex pb-4 justify-content-center">  

            <a class="pr-3" href="https://www.linkedin.com/in/jos%C3%A9-delgado-urbano-86a959144/" target="_blank">
               <img style="height: 40px;" src="/icons/linkedin.png">
            </a>

             <a class="pr-3" href="https://github.com/jslim/" target="_blank" >
               <img style="height: 40px;" src="/icons/github.png">
            </a>


            <a class="pr-3" href="https://wa.me/584263850897" target="_blank" >
               <img style="height: 40px;" src="/icons/wa.png">
            </a>

        </div>

        
        </footer>

    </div>



</body>
</html>
