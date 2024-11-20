@extends('dashboard.base')
@Section('title', 'Create Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('posts.create')
@endsection
