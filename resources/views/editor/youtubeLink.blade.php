@extends('dashboard.base')
@Section('title', 'Essential News')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('partials.youtube')
@endsection
