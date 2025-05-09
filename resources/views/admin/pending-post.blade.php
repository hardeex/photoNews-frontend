@extends('dashboard.base')
@Section('title', 'Admin Dashboar')


@section('sidebar')
    @include('admin.sidebar')
@endsection


@section('content')
    @include('posts.pending-posts')
@endsection
