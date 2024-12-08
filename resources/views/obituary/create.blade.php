@extends('dashboard.base')
@Section('title', 'Create Post - Missing Person')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('obituary.items.create-obituary-post')
@endsection


