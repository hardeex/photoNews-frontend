@extends('dashboard.base')
@Section('title', 'Create Category')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('category.create-category-seeder')
@endsection
