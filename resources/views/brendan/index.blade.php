@extends('layouts.app')

@section('header')
    <h1>
        <a href="/brendan">Brendan Murty</a>
    </h1>
@endsection

@section('content')
    {!! $content_html !!}

    @include('sections.social_brendan')
@endsection
