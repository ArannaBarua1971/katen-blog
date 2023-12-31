<!-- header -->
<header class="header-classic">

    <div class="container-xl">
        <!-- header top -->
        <div class="header-top">
            <div class="row align-items-center">

                <div class="col-md-4 col-xs-12">
                    <!-- site logo -->
                    <a class="navbar-brand" href="{{ route('homepage') }}"><img src="{{ asset('Frontend/images/logo.svg') }}" alt="logo" /></a> 
                </div>

                <div class="col-md-8 d-none d-md-block">
                    <!-- social icons -->
                    <ul class="social-icons list-unstyled list-inline mb-0 float-end">
                        <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-medium"></i></a></li>
                        <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg">
        <!-- header bottom -->
        <div class="header-bottom  w-100">
            
            <div class="container-xl">
                <div class="d-flex align-items-center">
                    <div class="collapse navbar-collapse flex-grow-1">
                        <!-- menus -->
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="index.html">Home</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.html">Magazine</a></li>
                                    <li><a class="dropdown-item" href="personal.html">Personal</a></li>
                                    <li><a class="dropdown-item" href="personal-alt.html">Personal Alt</a></li>
                                    <li><a class="dropdown-item" href="minimal.html">Minimal</a></li>
                                    <li><a class="dropdown-item" href="classic.html">Classic</a></li>
                                </ul>
                            </li>

                            @foreach ($catagories as $catagory )   
                                <li class="nav-item {{ count($catagory->subcatagories) ? 'dropdown':'' }}">

                                    <a class="nav-link  {{ count($catagory->subcatagories) ? 'dropdown-toggle':'' }}" href="{{ route('catagory.post.all',$catagory->id) }}">{{  $catagory->catagory_name }}</a>

                                    @if (count($catagory->subcatagories))
                                        <ul class="dropdown-menu">
                                            @foreach ($catagory->subcatagories as $subcatagory)  
                                                <li><a class="dropdown-item" href="{{ route('subcatagory.post.all',$subcatagory->id) }}">{{ $subcatagory->subcatagory_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach

                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{Route('login')}}">log in</a>
                            </li>
                            @endguest

                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">daseboard</a>
                            </li>
                            @endauth
                        </ul>
                    </div>

                    <!-- header buttons -->
                    <div class="header-buttons">
                        <button class="search icon-button">
                            <i class="icon-magnifier"></i>
                        </button>
                        <button class="burger-menu icon-button ms-2 float-end float-lg-none">
                            <span class="burger-icon"></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </nav>

</header>