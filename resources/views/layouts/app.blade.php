<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>@yield('title')</title>

        <meta name="author" content="@yield('site_author')">
        <meta name="description" content="@yield('site_description')">

        <meta name="handheldfriendly" content="true">
        <meta name="mobileoptimized" content="480">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="theme-color" content="@yield('site_theme')">
        <link rel="icon" sizes="192x192" href="@yield('site_icon')">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        @hasSection('site_feed_url')
        <link rel="alternate" title="@yield('site_feed_title')" type="application/json" href="@yield('site_feed_url')">
        @endif

        @hasSection('site_microblog_url')
        <link rel="me" href="@yield('site_microblog_url')">
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
    <body class="@yield('body_class')">
        <section id="sidebar">
            @yield('sidebar')
        </section>

        <section id="container" class="@yield('container_class')">
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
