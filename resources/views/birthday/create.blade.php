@extends('dashboard.base')
@Section('title', 'Create Birthday Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('birthday.items.create-birthday')
@endsection
