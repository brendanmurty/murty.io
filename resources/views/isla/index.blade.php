@extends('layouts.app')

@section('title', 'Isla Murty')
@section('title_short', 'IJM')
@section('site_author', 'Isla Murty')
@section('site_description', 'Loves salt and vinegar chips and plain crackers with Philadelphia.')
@section('site_theme', '14b3fb')
@section('site_icon', '/images/isla/icon-192.png')
@section('site_icon_large', '/images/isla/isla_murty.jpg')

@section('body_class', 'isla isla_index')

@section('header')
    <h1>
        <a href="/isla">Isla Murty</a>
    </h1>

    @include('sections.list_sites_header')
@endsection

@section('content')
    {!! $content_html !!}
@endsection
