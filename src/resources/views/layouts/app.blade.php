<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body>
    <div id="app" class="">
        @include('includes.nav')

        <main class="py-4">
            @yield('content')
        </main>
        @include('includes.footer')
    </div>
    @include('includes.scripts')
</body>

</html>