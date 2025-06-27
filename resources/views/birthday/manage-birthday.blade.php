@extends('dashboard.base')
@Section('title', 'Manage Birthday Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('birthday.items.manage-birthday')
@endsection
