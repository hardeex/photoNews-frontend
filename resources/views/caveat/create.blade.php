@extends('dashboard.base')
@Section('title', 'Create Caveat Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('caveat.items.create-caveat')
@endsection
