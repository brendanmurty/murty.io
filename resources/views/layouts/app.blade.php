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
        <link rel="icon" sizes="192x192" href="{{ $site['icon'] }}">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        @if (!empty($site['feed_url']))
        <link rel="alternate" title="{{ $site['feed_title'] }}" type="application/json" href="{{ $site['feed_url'] }}">
        @endif

        @if (!empty($site['microblog_url']))
        <link rel="me" href="{{ $site['microblog_url'] }}">
        @endif

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-97381586-1', 'auto');
            ga('send', 'pageview');
        </script>
    </head>
    <body @if(!empty($site['body_class']))class="{{ $site['body_class'] }}"@endif>
        <section id="sidebar">
            @yield('sidebar')
        </section>

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
