<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <!-- Icon -->
    <link rel="icon" href="{{ asset('/images/favicon.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    @stack('css-asset')
    <!-- App CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css-script')
</head>
<body>
<div id="app">
    <section class="px-8 py-4 mb-6">
        <header class="container mx-auto">
            <h1>
                <a href="{{ route('home') }}">
                    <img
                        src="/images/logo.svg"
                        alt="Tweety"
                    >
                </a>
            </h1>
        </header>
    </section>

    {{ $slot }}
</div>
<!-- Turbolinks JS -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>--}}
@stack('js-asset')
<!-- App JS -->
<script src="{{ asset('js/app.js') }}" defer></script>
@stack('js-script')
</body>
</html>
