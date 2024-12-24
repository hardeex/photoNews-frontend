@extends('dashboard.base')
@Section('title', 'Create Stolen Vehicle Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    @include('vehicle.items.create-vehicle')
@endsection
