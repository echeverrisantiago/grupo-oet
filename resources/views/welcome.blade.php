<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
        <div>
            @auth
            <a href="{{ url('/informes') }}" class="text-sm text-gray-700 dark:text-gray-500 float-right pr-5">Consultar informes</a>
            @else
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 float-right pr-5">Registro</a>
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 float-right pr-1">Login</a>
            @endauth
        </div>
        @endif
        <div class="d-flex justify-content-center w-100">
            <img src="{{ asset('/img/logo.png') }}" alt="2">
        </div>
    </div>
</body>

</html>