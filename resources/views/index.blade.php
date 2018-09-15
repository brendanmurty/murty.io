@extends('layouts.app')

@section('title', 'Murty')
@section('title_short', 'MUR')
@section('site_author', 'Brendan Murty')
@section('site_description', 'Murty websites')
@section('site_theme', '00549d')
@section('site_icon', '/images/common/murty-192.png')

@section('body_class', 'murty murty_index')
@section('container_class', 'listing avatars')

@section('header')
    <h1><a href="/">Murty</a></h1>
@endsection

@section('content')
    @include('sections.list_sites')
@endsection
