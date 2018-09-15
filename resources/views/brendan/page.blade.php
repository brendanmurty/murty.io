@extends('layouts.app')

@section('title', 'Brendan Murty')
@section('title_short', 'BCM')
@section('site_author', 'Brendan Murty')
@section('site_description', 'Brendan is a Senior Web Developer based in Sydney, Australia.')
@section('site_theme', '#00549d')
@section('site_icon', '/images/brendan/icon-192.png')
@section('site_icon_large', '/images/brendan/brendan_murty.jpg')
@section('site_feed_title', 'Posts by Brendan Murty')
@section('site_feed_url', 'https://murty.io/brendan/posts.json')
@section('microblog_url', 'https://micro.blog/brendanmurty')

@section('body_class', 'brendan brendan_' . $page_name)

@section('header')
    <h1>
        <a href="/brendan">Brendan Murty</a>
    </h1>

    @include('sections.list_sites_header')
@endsection

@section('content')
    {!! $content_html !!}
@endsection
