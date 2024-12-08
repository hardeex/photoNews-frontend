@extends('dashboard.base')
@Section('title', 'Create Post - Mispalced &amp; Found')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('misplace-and-found.items.create-misplace-post')
@endsection


