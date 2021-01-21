<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
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
                <img
                    src="/images/logo.svg"
                    alt="Tweety"
                >
            </h1>
        </header>
    </section>

    {{ $slot }}
</div>
<!-- Turbolinks JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>
@stack('js-asset')
<!-- App JS -->
<script src="{{ asset('js/app.js') }}" defer></script>
@stack('js-script')
</body>
</html>
