@extends('dashboard.base')
@Section('title', 'Create Wedding Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('wedding.items.create-wedding')
@endsection
