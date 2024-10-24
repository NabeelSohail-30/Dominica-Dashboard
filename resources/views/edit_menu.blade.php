@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
    <form action="{{ route('menu.update', base64_encode($menu->id)) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-header">
            <h2>App Menu</h2>
        </div>

        <div class="main-form">
            <div class="section main-head">
                <h4>Edit Menu</h4>
                <p>Update the information of your menu below.</p>
            </div>

            <div class="section form">
                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $menu->title) }}"
                        placeholder="e.g. Menu Title" required>
                </div>

                <!-- Spanish Title -->
                <div class="form-group">
                    <label for="title_sp">Spanish Title *</label>
                    <input type="text" name="title_sp" id="title_sp" value="{{ old('title_sp', $menu->title_sp) }}"
                        placeholder="e.g. Spanish Title" required>
                </div>

                <!-- French Title -->
                <div class="form-group">
                    <label for="title_fr">French Title *</label>
                    <input type="text" name="title_fr" id="title_fr" value="{{ old('title_fr', $menu->title_fr) }}"
                        placeholder="e.g. French Title" required>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="image">Image *</label>
                        <span>Upload an image</span>
                    </div>
                    <div class="form-control">
                        <div class="upload-box" onclick="document.getElementById('image').click()">
                            <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                            <div class="text"><span>Click to upload</span> or drag and drop</div>
                            <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                            <!-- Add 'name' attribute here -->
                            <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg, .webp">
                        </div>

                        <!-- Current Image Preview with Modal Trigger -->
                        <div class="curr-image">
                            @if ($menu->image)
                                <img src="{{ asset($menu->image) }}" alt="{{ $menu->title }}" class="img-preview"
                                    data-bs-toggle="modal" data-bs-target="#imageModal">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Background Image Upload -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="bg_image">Background Image *</label>
                        <span>Upload a background image</span>
                    </div>
                    <div class="form-control">
                        <div class="upload-box" onclick="document.getElementById('bg_image').click()">
                            <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                            <div class="text"><span>Click to upload</span> or drag and drop</div>
                            <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                            <!-- Add 'name' attribute here -->
                            <input type="file" id="bg_image" name="bg_image" accept=".png, .jpg, .jpeg, .webp">
                        </div>

                        <!-- Current Background Image Preview with Modal Trigger -->
                        <div class="curr-image">
                            @if ($menu->bg_image)
                                <img src="{{ asset($menu->bg_image) }}" alt="{{ $menu->title }}" class="img-preview"
                                    data-bs-toggle="modal" data-bs-target="#bgImageModal">
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-footer">
            <!-- Action Buttons -->
            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Update</button>
            </div>
        </div>
    </form>

    <!-- Modal for Main Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Current Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->title }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Background Image -->
    <div class="modal fade" id="bgImageModal" tabindex="-1" aria-labelledby="bgImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bgImageModalLabel">Current Background Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset($menu->bg_image) }}" alt="{{ $menu->title }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit_menu.css') }}">
    <style>
        /* CSS to blur background when modal is open */
        .modal-backdrop {
            backdrop-filter: blur(5px);
        }

        .img-preview {
            cursor: pointer;
            max-width: 100px;
            /* Adjust preview size */
            height: auto;
            transition: transform 0.2s;
        }

        .img-preview:hover {
            transform: scale(1.05);
            /* Zoom effect on hover */
        }

        .modal-body img {
            max-width: 100%;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
