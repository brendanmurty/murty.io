@extends('layouts.app')

@section('header')
    <h1><a href="/">Murty</a></h1>
@endsection

@section('content')
    @include('sections.list_sites')
@endsection
