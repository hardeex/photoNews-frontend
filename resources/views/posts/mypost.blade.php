@extends('dashboard.base')
@Section('title', 'Manage Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('posts.manage')
@endsection
