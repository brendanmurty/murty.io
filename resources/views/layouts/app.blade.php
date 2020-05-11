<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>{{ $site['title'] }}</title>

        <meta name="author" content="{{ $site['author'] }}">
        <meta name="description" content="{{ $site['description'] }}">
        <meta name="handheldfriendly" content="true">
        <meta name="mobileoptimized" content="480">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="{{ $site['theme'] }}">

        <link rel="preload" href="{{ asset('fonts/slabo-27_latin-ext.woff2') }}" as="font" crossorigin="anonymous">
        <link rel="preload" href="{{ asset('fonts/slabo-27_latin.woff2') }}" as="font" crossorigin="anonymous">
        <link rel="preconnect" href="https://cdn.usefathom.com/">

        <link rel="icon" sizes="192x192" href="{{ asset($site['icon']) }}">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        @if (!empty($site['feed_url']))
        <link rel="alternate" title="{{ $site['feed_title'] }}" type="application/json" href="{{ $site['feed_url'] }}">
        @endif

        @if (!empty($site['microblog_url']))
        <link rel="me" href="{{ $site['microblog_url'] }}">
        @endif

        <!-- Fathom - simple website analytics - https://usefathom.com -->
        <script src="https://cdn.usefathom.com/script.js" site="VHORKFKF" excluded-domains="localhost" defer></script>
    </head>
    <body @if(!empty($site['body_class']))class="{{ $site['body_class'] }}"@endif>
        <section id="container" @if(!empty($site['container_class']))class="{{ $site['container_class'] }}"@endif>
            <header>
                @yield('header')
            </header>
            <article>
                @yield('content')
            </article>
            <footer>
                @yield('footer')
            </footer>
        </section>

        <!-- Fathom - simple website analytics - https://usefathom.com -->
        @if($site['body_class'] == 'brendan brendan_resume')
        <script>
        window.addEventListener('load', (event) => {
            fathom.trackGoal('ZOBT07DG', 0);
        });
        </script>
        @elseif($site['body_class'] == 'gallery gallery_index')
        <script>
        window.addEventListener('load', (event) => {
            fathom.trackGoal('BDCOVA7P', 0);
        });
        </script>
        @endif
    </body>
</html>
