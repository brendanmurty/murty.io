@extends('layouts.app')

@section('header')
    <h1>
        <a href="/brendan">
            <img class="avatar" alt="BCM" width="150" height="150" src="/{{ $site['icon_large'] }}">
            <span class="name">Brendan Murty</span>
        </a>
    </h1>
@endsection

@section('content')
    {!! $content_html !!}

    @include('sections.social_brendan')
@endsection
