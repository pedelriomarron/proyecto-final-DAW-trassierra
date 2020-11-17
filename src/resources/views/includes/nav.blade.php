<!-- 



@if (Route::has('login'))
<div class="top-right links">
    @auth
    <a href="{{ url('/home') }}">Home</a>
    @else
    <a href="{{ route('login') }}">Login</a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}">Register</a>
    @endif
    @endauth
</div>
@endif

<nav class="navbar navbar-dark bg-dark justify-content-between navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white">
            <img src="./img/logo_white.svg" width="50vw" alt="Logo">
            Coches Electricos
        </a>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<style>
    .navbar-nav.navbar-center {
        position: relative;
        left: 50%;
        transform: translatex(-50%);
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav navbar-center ">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('cars.index') }}">{{ __('Cars') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="locale/es">@lang('sentence.spanish')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="locale/en">@lang('sentence.english')</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Laravel 8 User Roles and Permissions - ItSolutionStuff.com
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto"></ul>


<ul class="navbar-nav ml-auto">
    @guest
    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
    @else
    <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
    <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
    <li><a class="nav-link" href="{{ route('products.index') }}">Manage Product</a></li>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>


        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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



-->

<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo_white.svg/') }}" width="50vw" alt="Logo"> Vehículos Eléctricos
        </a>
        @include('includes.toogleDarkMode')

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('car_public_index') }}">{{ __('cars') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">{{ __('contact') }}</a>
                </li>
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
                <!-- 
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Administrar</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('users.index') }}">Administrar Usuarios</a>
                        <a class="dropdown-item" href="{{ route('roles.index') }}">Administrar Roles</a>
                        <a class="dropdown-item" href="{{ route('products.index') }}">Administrar Productos</a>
                        <a class="dropdown-item" href="{{ route('brands.index') }}">Administrar Brands</a>

                    </div>
                </li>
                -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                        style="position: relative;padding-left:50px">
                        <img src="{{ asset('uploads/avatars/'.Auth::user()->avatar.'') }}"
                            style="width: 2rem; height:2rem;border-radius:50%;position:absolute; top:10px;left:10px">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest

                <li class="nav-item">
                    <language-switcher locale="{{ app()->getLocale() }}"
                        link-en="{{ route('locale', ['locale' => 'en']) }}"
                        link-es="{{ route('locale', ['locale' => 'es']) }}" flag="{{ asset('img/flags/')}}">
                    </language-switcher>
                </li>

            </ul>
        </div>
    </div>
</nav>
