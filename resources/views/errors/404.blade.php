<?php

$site = [
    'title' => 'Murty',
    'title_short' => 'MUR',
    'author' => 'Brendan Murty',
    'description' => 'Murty websites',
    'theme' => '#00549d',
    'icon' => asset('images/common/murty-192.png'),
    'icon_large' => asset('images/common/murty-192.png'),
    'body_class' => 'murty murty_index',
    'container_class' => 'listing avatars'
];

?>

@extends('layouts.app')

@section('header')
    <h1><a href="/">Murty</a></h1>
@endsection

@section('content')
    @include('sections.list_sites')
@endsection
