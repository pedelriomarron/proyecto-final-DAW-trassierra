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