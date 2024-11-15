@extends('layouts.admin')

@section('title', 'Add Detail')

@section('content')
    <div class="container">
        <div class="form-header">
            <div class="bread-crumb">
                <span><a href="{{ route('dashboard') }}"><img src="{{ asset('images/home-icon.svg') }}"
                            alt="Home"></a></span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Menu</span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Listing</span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Detail</span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Add Detail</span>
            </div>
            <div class="sub-header">
                <h2>Listing</h2>
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    <style>
        .table-section {
            margin-top: 120px;
            padding: 32px;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
