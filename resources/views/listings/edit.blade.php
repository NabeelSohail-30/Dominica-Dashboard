@extends('layouts.admin')

@section('title', 'Edit Listing')

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
        <form id="listingForm" action="{{ route('listing.update', ['id' => $listing->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="main-form">
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" value="{{ $listing->title }}" required>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="image">Image</label>
                        <span>Upload an image</span>
                    </div>
                    <div class="form-control">
                        <div class="upload-box" onclick="document.getElementById('image').click()">
                            <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                            <div class="text"><span>Click to upload</span> or drag and drop</div>
                            <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                            <input type="file" name="image" id="image">
                        </div>

                        <!-- Current Image Preview with Modal Trigger -->
                        <div class="curr-image">
                            @if ($listing->image)
                                <img src="{{ asset($listing->image) }}" alt="Current Image"
                                    style="max-width: 200px; margin-top: 10px; cursor: pointer;" class="img-preview"
                                    data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal(this)">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-text">
                        <label for="bg_image">Background Image</label>
                        <span>Upload an image</span>
                    </div>
                    <div class="form-control">
                        <div class="upload-box" onclick="document.getElementById('bg_image').click()">
                            <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                            <div class="text"><span>Click to upload</span> or drag and drop</div>
                            <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                            <input type="file" name="bg_image" id="bg_image">
                        </div>

                        <!-- Current Image Preview with Modal Trigger -->
                        <div class="curr-image">
                            @if ($listing->bg_image)
                                <img src="{{ asset($listing->bg_image) }}" alt="Current Background Image"
                                    style="max-width: 200px; margin-top: 10px; cursor: pointer;" class="img-preview"
                                    data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal(this)">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <div class="form-actions">
                    <button type="submit" class="btn-save">Save</button>
                    <button type="button" class="btn-cancel"
                        onclick="window.location='{{ route('dashboard') }}'">Cancel</button>
                </div>
            </div>
        </form>

        <!-- Modal for Image Preview -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="" alt="Preview Image"
                            style="width: 100%; max-height: 70vh; object-fit: contain;">
                    </div>
                </div>
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

        .modal-backdrop {
            backdrop-filter: blur(5px);
        }


        .upload-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px 147px;
            gap: 10px;
            width: 512px;
            height: 125px;
            background: #f6f9f9;
            border: 1px dashed #d5d7da;
            border-radius: 9px;
            cursor: pointer;
        }

        .upload-box input[type="file"] {
            display: none;
        }

        .upload-box .text {
            font-weight: 400;
            font-size: 14px;
            color: #969db2;
        }

        .upload-box .text span {
            color: #02635c;
            font-weight: 600;
        }

        .upload-box .subtext {
            font-weight: 400;
            font-size: 12px;
            color: #969db2;
        }

        .upload-box .icon {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid #d5d7da;
            filter: drop-shadow(0px 1px 2px rgba(0, 0, 0, 0.25));
            border-radius: 7px;
        }

        .upload-box .icon img {
            width: 20px;
            height: 20px;
        }

        .section.form .form-control {
            display: flex;
            flex-direction: column;
            padding: 0px 0px 20px;
            gap: 12px;
            width: 100%;
            height: auto;
            border: none;
        }

        .curr-image img {
            width: 100px !important;
            height: 100px !important;
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
    <script>
        function showImageModal(imgElement) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imgElement.src;
        }
    </script>

@endsection
