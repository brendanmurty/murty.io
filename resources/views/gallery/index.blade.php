@extends('layouts.app')

@section('header')
    <h1>
        <a href="/gallery">Gallery</a>
    </h1>

    @include('sections.breadcrumbs')
@endsection

@section('content')
    {!! $content_html !!}
    <script src="{{ asset('js/gallery.min.js') }}"></script>
@endsection
