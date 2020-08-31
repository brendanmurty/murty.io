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
        <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">

        @if (!empty($site['feed_url']))
        <link rel="alternate" title="{{ $site['feed_title'] }}" type="application/json" href="{{ $site['feed_url'] }}">
        @endif

        @if (!empty($site['microblog_url']))
        <link rel="me" href="{{ $site['microblog_url'] }}">
        @endif

        <!-- Fathom - simple website analytics - https://github.com/usefathom/fathom -->
        <script>
        (function(f, a, t, h, o, m){
        	a[h]=a[h]||function(){
        		(a[h].q=a[h].q||[]).push(arguments)
        	};
        	o=f.createElement('script'),
        	m=f.getElementsByTagName('script')[0];
        	o.async=1; o.src=t; o.id='fathom-script';
        	m.parentNode.insertBefore(o,m)
        })(document, window, '//stats.murty.io/tracker.js', 'fathom');
        fathom('set', 'siteId', 'UTUOD');
        fathom('trackPageview');
        </script>
        <!-- / Fathom -->
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
    </body>
</html>
