@extends('dashboard.base')
@Section('title', 'Create Dedication Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('dedication.items.create-dedication')
@endsection
