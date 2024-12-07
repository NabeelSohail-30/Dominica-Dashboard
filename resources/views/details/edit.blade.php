@extends('layouts.admin')

@section('title', 'Edit Detail')

@section('content')
    <div class="container">
        <div class="form-header">
            <div class="bread-crumb">
                <span>
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/home-icon.svg') }}" alt="Home">
                    </a>
                </span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>
                    <a onclick="goBackBack();" style="cursor: pointer;">Listing</a>
                </span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>
                    <a onclick="goBack();" style="cursor: pointer;">Details</a>
                </span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Edit Details</span>
            </div>
            <div class="sub-header">
                <h2>Edit Details</h2>
            </div>
        </div>

        <form id="listingForm" action="{{ route('details.update', ['id' => $details->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="main-form">
                <!-- Text Fields -->
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" placeholder="e.g. Listing Title" required
                        value="{{ $details->title }}">
                </div>

                <div class="form-group">
                    <label for="sub_title">Subtitle *</label>
                    <input type="text" name="sub_title" id="sub_title" placeholder="e.g. Subtitle" required
                        value="{{ $details->sub_title }}">
                </div>

                <div class="form-group">
                    <label for="push_welcome_title">Push Welcome Title *</label>
                    <input type="text" name="push_welcome_title" id="push_welcome_title" placeholder="e.g. Welcome Title"
                        required value="{{ $details->push_welcome_title }}">
                </div>

                <div class="form-group">
                    <label for="push_body">Push Body *</label>
                    <textarea name="push_body" id="push_body" placeholder="e.g. Push notification body" required>{{ $details->push_body }}</textarea>
                </div>

                <!-- Descriptions -->
                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea name="description" id="description" placeholder="e.g. Description" required>{{ $details->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description_sp">Description (Spanish) *</label>
                    <textarea name="description_sp" id="description_sp" placeholder="e.g. Descripción en Español" required>{{ $details->description_sp }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description_fr">Description (French) *</label>
                    <textarea name="description_fr" id="description_fr" placeholder="e.g. Description en Français" required>{{ $details->description_fr }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description_2">Description 2</label>
                    <textarea name="description_2" id="description_2" placeholder="e.g. Additional Description">{{ $details->description_2 }}</textarea>
                </div>

                <!-- Images -->
                <div class="form-group">
                    <label for="flag">Upload Flag (For Capital City) *</label>
                    <div class="upload-box" onclick="document.getElementById('flag').click()" data-input-id="flag">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="flag" id="flag">
                    </div>
                    <div class="curr-image">
                        @if ($details->flag)
                            <img src="{{ asset($details->flag) }}" alt="Flag Image" class="img-preview"
                                style="max-width: 200px; margin-top: 10px; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#imageModal" data-src="{{ asset($details->flag) }}">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image | Icon | Thumbnail *</label>
                    <div class="upload-box" onclick="document.getElementById('image').click()" data-input-id="image">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="curr-image">
                        @if ($details->image)
                            <img src="{{ asset($details->image) }}" alt="Background Image"
                                style="max-width: 200px; margin-top: 10px;" class="img-preview" data-bs-toggle="modal"
                                data-bs-target="#imageModal" data-src="{{ asset($details->image) }}">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="bg_image">Background Image *</label>
                    <div class="upload-box" onclick="document.getElementById('bg_image').click()"
                        data-input-id="bg_image">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="bg_image" id="bg_image">
                    </div>
                    <div class="curr-image">
                        @if ($details->bg_image)
                            <img src="{{ asset($details->bg_image) }}" alt="Background Image"
                                style="max-width: 200px; margin-top: 10px;" class="img-preview" data-bs-toggle="modal"
                                data-bs-target="#imageModal" data-src="{{ asset($details->bg_image) }}">
                        @endif
                    </div>
                </div>

                <!-- Location Details -->
                <div class="form-group">
                    <label for="latitude">Latitude *</label>
                    <input type="text" name="latitude" id="latitude" placeholder="e.g. 37.7749" required
                        value="{{ $details->latitude }}">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude *</label>
                    <input type="text" name="longitude" id="longitude" placeholder="e.g. -122.4194" required
                        value="{{ $details->longitude }}">
                </div>

                <div class="form-group">
                    <label for="radius">Radius *</label>
                    <input type="number" name="radius" id="radius" placeholder="e.g. 50" required
                        value="{{ $details->radius }}">
                </div>

                <div class="form-group">
                    <label for="location">Location *</label>
                    <input type="text" name="location" id="location" placeholder="e.g. San Francisco" required
                        value="{{ $details->location }}">
                </div>

                <!-- Other Details -->
                <div class="form-group">
                    <label for="year">Year *</label>
                    <input type="number" name="year" id="year" placeholder="e.g. 2024" required
                        value="{{ $details->year }}">
                </div>

                <div class="form-group">
                    <label for="date">Date *</label>
                    <input type="date" name="date" id="date" required value="{{ $details->date }}">
                </div>

                <div class="form-group">
                    <label for="day">Day *</label>
                    <input type="text" name="day" id="day" placeholder="e.g. Monday" required
                        value="{{ $details->day }}">
                </div>

                <div class="form-group">
                    <label for="timing">Timing *</label>
                    <input type="text" name="timing" id="timing" placeholder="e.g. 9:00 AM - 5:00 PM" required
                        value="{{ $details->timing }}">
                </div>

                <!-- Contact Information -->
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" placeholder="e.g. example@example.com" required
                        value="{{ $details->email }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone *</label>
                    <input type="tel" name="phone" id="phone" placeholder="e.g. +123456789" required
                        value="{{ $details->phone }}">
                </div>

                <div class="form-group">
                    <label for="whatsappNum">WhatsApp Number *</label>
                    <input type="tel" name="whatsappNum" id="whatsappNum" placeholder="e.g. +123456789" required
                        value="{{ $details->whatsappNum }}">
                </div>

                <div class="form-group">
                    <label for="website">Website *</label>
                    <input type="url" name="website" id="website" placeholder="e.g. https://example.com" required
                        value="{{ $details->website }}">
                </div>

                <div class="form-group">
                    <label for="video">Video *</label>
                    <div class="upload-box" onclick="document.getElementById('video').click()" data-input-id="video">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="video" id="video">
                    </div>
                    <div class="curr-image">
                        @if ($details->video)
                            <video class="video-preview" style="max-width: 200px; margin-top: 10px; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#videoModal"
                                data-src="{{ asset($details->video) }}">
                                <source src="{{ asset($details->video) }}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                </div>

                <!-- Boolean Fields as Dropdowns -->
                <div class="form-group">
                    <label for="geo_fencing">Geo Fencing</label>
                    <select id="geo_fencing" name="geo_fencing">
                        <option value="1" {{ $details->geo_fencing ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$details->geo_fencing ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gallery_status">Gallery Images *</label>
                    <select id="gallery_status" name="gallery_status">
                        <option value="1" {{ $details->gallery_status ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$details->gallery_status ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="vgallery_status">Gallery Videos *</label>
                    <select id="vgallery_status" name="vgallery_status">
                        <option value="1" {{ $details->vgallery_status ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$details->vgallery_status ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="has_trail">Has Trail</label>
                    <select id="has_trail" name="has_trail">
                        <option value="1" {{ $details->has_trail ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$details->has_trail ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="has_360">Has 360</label>
                    <select id="has_360" name="has_360">
                        <option value="1" {{ $details->has_360 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$details->has_360 ? 'selected' : '' }}>No</option>
                    </select>
                </div>


                <!-- Links -->
                <div class="form-group">
                    <label for="booking_url">Booking URL *</label>
                    <input type="url" name="booking_url" id="booking_url" placeholder="e.g. https://booking.com"
                        required value="{{ $details->booking_url }}">
                </div>

                <div class="form-group">
                    <label for="registration_link">Registration Link *</label>
                    <input type="url" name="registration_link" id="registration_link"
                        placeholder="e.g. https://register.com" required value="{{ $details->registration_link }}">
                </div>

                <!-- Modal Template -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img id="modalImage" src="" alt="Preview" style="width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <video id="modalVideo" controls style="width: 100%; height: auto;">
                                    <source src="" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Footer -->
            <div class="form-footer">
                <div class="form-actions">
                    <button type="submit" class="btn-save">Update</button>
                    <button type="button" class="btn-cancel"
                        onclick="window.location='{{ route('dashboard') }}'">Cancel</button>
                </div>
            </div>
        </form>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    <style>
        .table-section {
            margin-top: 120px;
            padding: 32px;
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
            background-color: #f0f8ff;
            border-color: #007bff;
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
        document.addEventListener('DOMContentLoaded', () => {
            const uploadBoxes = document.querySelectorAll('.upload-box');

            uploadBoxes.forEach(box => {
                const inputId = box.getAttribute('data-input-id');
                const fileInput = document.getElementById(inputId);

                // Handle click event
                box.addEventListener('click', () => fileInput.click());

                // Handle drag-and-drop
                box.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    box.classList.add('drag-over');
                });

                box.addEventListener('dragleave', () => {
                    box.classList.remove('drag-over');
                });

                box.addEventListener('drop', (e) => {
                    e.preventDefault();
                    box.classList.remove('drag-over');

                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files; // Assign files to the input
                    }
                });

                // File input change event
                fileInput.addEventListener('change', () => handlePreview(fileInput, box));
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Handle Image Modal
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            document.querySelectorAll('.img-preview').forEach(img => {
                img.addEventListener('click', function() {
                    modalImage.src = img.getAttribute('data-src');
                });
            });

            // Handle Video Modal
            const videoModal = document.getElementById('videoModal');
            const modalVideo = document.getElementById('modalVideo');
            document.querySelectorAll('.video-preview').forEach(video => {
                video.addEventListener('click', function() {
                    modalVideo.src = video.getAttribute('data-src');
                });
            });

            // Clear video source when modal is closed
            videoModal.addEventListener('hidden.bs.modal', function() {
                modalVideo.src = '';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            @endif
        });

        function goBack() {
            if (document.referrer) {
                window.location = document.referrer; // Navigate to the previous page
            } else {
                window.location = '{{ route('dashboard') }}'; // Fallback to dashboard
            }
        }

        function goBackBack() {
            // If history exists, go back two steps
            if (window.history.length > 2) {
                window.history.go(-2); // Navigate back two steps
            } else {
                window.location = '{{ route('dashboard') }}'; // Fallback to dashboard
            }
        }
    </script>
@endsection
