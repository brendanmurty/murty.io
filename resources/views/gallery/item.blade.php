@extends('layouts.app')

@section('header')
    <h1>
        <a href="/gallery">Gallery</a>
    </h1>

    @include('sections.breadcrumbs')
@endsection

@section('content')
    {!! $content_html !!}
@endsection
