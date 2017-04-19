<?php include('lib/redirects.php'); ?><!doctype html>
<html lang="en" ng-app="murtyApp" ng-controller="headerCtrl">
  <head>
    <meta charset="utf-8">
    <title ng-bind="site_title"></title>
    <meta name="author" content="{{ site_author }}">
    <meta name="description" content="{{ site_description }}">
    <meta name="handheldfriendly" content="true">
    <meta name="mobileoptimized" content="480">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <base href="/">
    <link rel="icon" href="{{ icon_shortcut }}">
    <link rel="apple-touch-icon-precomposed" href="{{ icon_touch }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Slabo+27px"> 
    <link rel="stylesheet" href="/css/build/murty.min.css">
    <script src="/js/build/murty.min.js"></script>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-97381586-1', 'auto');
    ga('send', 'pageview');
    </script>
  </head>
  <body
    class="{{ class_page }}"
    ng-view
  ></body>
</html>
