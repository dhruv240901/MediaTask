@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('vendor-script')
    @include('components.toastr')
@endsection

@section('content')
    <div class="row mt-5">
        <h1 class="text-center">Welcome {{ auth()->user()->name }}</h1>
    </div> <!-- row -->
@endsection
