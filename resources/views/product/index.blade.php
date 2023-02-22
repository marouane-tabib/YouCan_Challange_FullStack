@extends('layouts.app')
@section('title' , 'Products')

@section('content')
    @include('components.filter')
    @include('components.modal')
    @include('components.table')
@endsection
