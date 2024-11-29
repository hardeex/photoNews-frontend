@extends('admin.base')
@Section('title', 'Admin Dashboar')


@section('sidebar')
    @include('admin.sidebar')
@endsection


@section('content')
    @include('admin.partials.dashboard')
@endsection
