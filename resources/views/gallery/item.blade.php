@extends('layouts.app')

@section('header')
    <h1>
        <a href="/gallery">Gallery</a>
    </h1>

    @include('sections.list_sites_header')

    @include('sections.breadcrumbs')
@endsection

@section('content')
    {!! $content_html !!}
    <script src="{{ mix('/js/gallery.js') }}"></script>
@endsection
