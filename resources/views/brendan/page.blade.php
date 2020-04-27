@extends('layouts.app')

@section('header')
    <h1>
        <a href="/brendan">Brendan Murty</a>
    </h1>
    
    @include('sections.breadcrumbs')
@endsection

@section('content')
    {!! $content_html !!}
@endsection
