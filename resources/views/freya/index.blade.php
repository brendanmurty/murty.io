@extends('layouts.app')

@section('title', 'Freya Murty')
@section('title_short', 'FJM')
@section('site_author', 'Brendan Murty')
@section('site_description', 'The latest addition to the family.')
@section('site_theme', '981ceb')
@section('site_icon', '/images/freya/icon-192.png')
@section('site_icon_large', '/images/freya/freya_murty.jpg')

@section('body_class', 'freya freya_index')

@section('header')
    <h1>
        <a href="/freya">Freya Murty</a>
    </h1>

    @include('sections.list_sites_header')
@endsection

@section('content')
    {!! $content_html !!}
@endsection
