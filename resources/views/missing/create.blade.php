@extends('dashboard.base')
@Section('title', 'Create Post - Missing Person')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('missing.items.create-missing-person-post')
@endsection


