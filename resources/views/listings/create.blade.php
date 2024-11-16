@extends('layouts.admin')

@section('title', 'Create Listing')

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
            </div>
            <div class="sub-header">
                <h2>Listing</h2>
            </div>
        </div>

        <!-- Form Section -->
        <form id="listingForm" action="{{ route('listing.store', ['id' => $id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="main-form">
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" placeholder="e.g. Listing Title" required>
                </div>

                <div class="form-group">
                    <label for="image">Image *</label>
                    <div class="upload-box" onclick="document.getElementById('image').click()">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                        <input type="file" name="image" id="image" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bg_image">Background Image *</label>
                    <div class="upload-box" onclick="document.getElementById('bg_image').click()">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                        <input type="file" name="bg_image" id="bg_image" required>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-footer">
                <div class="form-actions">
                    <button type="submit" class="btn-save">Save</button>
                    <button type="button" class="btn-cancel"
                        onclick="window.location='{{ route('dashboard') }}'">Cancel</button>
                </div>
            </div>
        </form>
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
