@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
    <form action="{{ route('about_us.update', base64_encode($aboutUs->id)) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-header">
            <div class="bread-crumb">
                <span><a onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer"><img
                            src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>About Us</span>
            </div>
            <h2>About Us</h2>
        </div>

        <div class="main-form">
            <div class="section main-head">
                <h4>Edit About</h4>
                <span>Update the information about your app below.</span>
            </div>

            <div class="section form">
                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $aboutUs->title) }}"
                        placeholder="e.g. About Title" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="description">Description *</label>
                        <span>Write a brief description about your app.</span>
                    </div>
                    <textarea name="description" id="description" rows="5" placeholder="Enter description" required>{{ old('description', $aboutUs->description) }}</textarea>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="image">Image *</label>
                        <span>Upload an image for your app.</span>
                    </div>
                    <div class="form-control">
                        <div class="upload-box" onclick="document.getElementById('about_image').click()">
                            <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                            <div class="text"><span>Click to upload</span> or drag and drop</div>
                            <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                            <input type="file" id="about_image" name="about_image" accept=".png, .jpg, .jpeg, .webp">
                        </div>

                        <!-- Current Image Preview with Modal Trigger -->
                        <div class="curr-image">
                            @if ($aboutUs->about_image)
                                <img src="{{ asset($aboutUs->about_image) }}" alt="{{ $aboutUs->title }}"
                                    class="img-preview" data-bs-toggle="modal" data-bs-target="#imageModal">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="form-group">
                    <div class="form-text">
                        <h4 class="social-links-title">Social Media Links</h4>
                        <span>Add your social media links.</span>
                    </div>
                    <div class="social-media-links">
                        <!-- Facebook -->
                        <input type="url" name="facebook_url" id="facebook_url"
                            value="{{ old('facebook', $aboutUs->facebook_url) }}"
                            placeholder="e.g. https://www.facebook.com/your-page">
                        <!-- Twitter -->
                        <input type="url" name="twitter_url" id="twitter_url"
                            value="{{ old('twitter', $aboutUs->twitter_url) }}"
                            placeholder="e.g. https://www.twitter.com/your-page">
                        <!-- Instagram -->
                        <input type="url" name="instagram_url" id="instagram_url"
                            value="{{ old('instagram', $aboutUs->instagram_url) }}"
                            placeholder="e.g. https://www.instagram.com/your-page">
                        <!-- LinkedIn -->
                        <input type="url" name="linkedin_url" id="linkedin_url"
                            value="{{ old('linkedin', $aboutUs->linkedin_url) }}"
                            placeholder="e.g. https://www.linkedin.com/in/your-profile">
                        <!-- YouTube -->
                        <input type="url" name="youtube_url" id="youtube_url"
                            value="{{ old('youtube', $aboutUs->youtube_url) }}"
                            placeholder="e.g. https://www.youtube.com/channel/your-channel">
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
                    <img src="{{ asset($aboutUs->about_image) }}" alt="{{ $aboutUs->title }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Validation Errors</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit_about_us.css') }}">
    <style>
        .modal-backdrop {
            backdrop-filter: blur(5px);
        }

        .img-preview {
            cursor: pointer;
            max-width: 100px;
            height: auto;
            transition: transform 0.2s;
        }

        .img-preview:hover {
            transform: scale(1.05);
        }

        .modal-body img {
            max-width: 100%;
        }

        #errorModal .modal-body ul {
            padding-left: 1.5rem;
            list-style-type: disc;
        }

        #errorModal .modal-body ul li {
            color: red;
            font-size: 0.9em;
        }

        .upload-box.drag-over {
            border: 2px dashed #007bff;
            background-color: #f8f9fa;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            @endif
        });

        document.addEventListener("DOMContentLoaded", function() {
            const uploadBox = document.querySelector(".upload-box");
            const fileInput = document.getElementById("about_image");

            uploadBox.addEventListener("dragover", (event) => {
                event.preventDefault(); // Prevent the default behavior
                uploadBox.classList.add("drag-over");
            });

            uploadBox.addEventListener("dragleave", () => {
                uploadBox.classList.remove("drag-over");
            });

            uploadBox.addEventListener("drop", (event) => {
                event.preventDefault(); // Prevent the default behavior
                uploadBox.classList.remove("drag-over");

                const files = event.dataTransfer.files; // Get dropped files
                if (files.length > 0) {
                    fileInput.files = files; // Assign files to the input
                    // Optional: Trigger any file preview or validation logic here
                }
            });

            uploadBox.addEventListener("click", () => {
                fileInput.click(); // Simulate click to open file dialog
            });
        });
    </script>
@endsection
