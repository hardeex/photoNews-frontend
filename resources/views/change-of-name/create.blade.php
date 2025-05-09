@extends('dashboard.base')
@Section('title', 'Create Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('change-of-name.items.create-change-of-name-post')
@endsection
