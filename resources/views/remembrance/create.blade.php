@extends('dashboard.base')
@Section('title', 'Create Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('remembrance.items.create-remembrance-post')
@endsection


