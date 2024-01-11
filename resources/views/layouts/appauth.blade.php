<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        .active{
        color: rgb(255, 0, 0);
        -webkit-text-stroke-width: 1px;
        }
        .inactive{
        color: rgb(0, 0, 255);
        -webkit-text-stroke-width: 0.4px;
        }


        .search{
            position:relative;
        }
        #searchInput{
            font-size:18px;
        }
        #searchBar{
            width:500px;
            height:500px;
            background:#e6fdff;
            position: absolute;
            z-index: 10;
            border-radius:10px;
            display:none;
            opacity: 0.9810;
            margin-top:2px;
            
        }
        #searchBar h1{
            padding:15px 0 0 15px;
            float:left;
            font-weight:bold;
            font-size:25px;
        }
        #searchBar #view{
            float:right;
            text-decoration:none;
            font-size:18px;
            padding : 15px 15px 0 0;
        }
        #searchBar #view:hover{
            text-decoration:underline;
        }
        #searchBar #history{
            width:75%;
            padding:5px;
            
        }
        #searchBar #history #search{
            text-align:left;
            border:none;
            background:transparent;
            margin:0 0 0 8px;
            color:black;
            font-size : 22px;
            text-decoration:none;
        }
        #searchBar #history #search:hover{
            color:blue;
        }
        


    </style>
    @yield('style')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Custom styles for this template-->
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="overflow-x: hidden;background:linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(190,190,172,1) 35%, rgba(0,212,255,1) 100%);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light transparent shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <b><span style="font-size : 35px;margin:0 30px 0 0;color:white;">Mobily</span></b>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>




                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="color:white;font-size:17px;">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color:white;font-size:17px;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                                <!-- Topbar Search -->
                                <div class="search">
                                    <div id="search_form">
                                        <form action="{{route('search')}}" method="GET" autocomplete="off"
                                        style="margin:0 270px 0 0;" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-light border-0" placeholder="Search for..."
                                                    aria-label="Search" aria-describedby="basic-addon2" style="width:300px;"
                                                    id="searchInput" name="search">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fa fa-search "></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                   
                                    <div id="searchBar">
                                            <h1>Recent Search</h1>
                                            <a href="{{route('history')}}" id="view">View all</a><br>
                                            @foreach($retrieve_history as $search)
                                                <div class="row" id="history">
                                                <a href="{{route('search' , $search->content)}}" name="history" id="search">{{$search->content}}</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    
    
                                </div>


                            <a href="{{route('mycart')}}"> <i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i></a>
                            <a href="{{route('fav_product')}}"> <i class="fa fa-heart-o" style="font-size:22px;padding:8px 5px 0 0;"></i></a>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                            
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

        <nav>
            @yield('nav')
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <script type="text/javascript">

        $("#search_form").focusin(function(){
            $("#searchBar").css('display','block');
        });

        $(document).mouseup(function(e) 
     {
    var container = $("#searchBar");
    var searchbar = $("#search_form")

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                if(!searchbar.is(e.target) && searchbar.has(e.target).length === 0)
                {container.hide();}
            }
        });

    

        

      
        

    </script>
</body>
</html>
