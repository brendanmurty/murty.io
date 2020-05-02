@extends('layouts.app')

@section('header')
    <h1>
        <a href="/brendan">
            <img class="avatar" alt="BCM" src="/{{ $site['icon_large'] }}">
            <span class="name">Brendan Murty</span>
        </a>
    </h1>
@endsection

@section('content')
    {!! $content_html !!}
@endsection
