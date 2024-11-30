@extends('layouts.admin')

@section('title', 'Add Detail')

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
                <span>Add Details</span>
            </div>
            <div class="sub-header">
                <h2>Add Details</h2>
            </div>
        </div>

        <form id="listingForm" action="{{ route('details.store', ['id' => $id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="main-form">
                <!-- Text Fields -->
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" placeholder="e.g. Listing Title" required>
                </div>

                <div class="form-group">
                    <label for="sub_title">Subtitle *</label>
                    <input type="text" name="sub_title" id="sub_title" placeholder="e.g. Subtitle" required>
                </div>

                <div class="form-group">
                    <label for="push_welcome_title">Push Welcome Title *</label>
                    <input type="text" name="push_welcome_title" id="push_welcome_title" placeholder="e.g. Welcome Title"
                        required>
                </div>

                <div class="form-group">
                    <label for="push_body">Push Body *</label>
                    <textarea name="push_body" id="push_body" placeholder="e.g. Push notification body" required></textarea>
                </div>

                <!-- Descriptions -->
                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea name="description" id="description" placeholder="e.g. Description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="description_sp">Description (Spanish) *</label>
                    <textarea name="description_sp" id="description_sp" placeholder="e.g. Descripción en Español" required></textarea>
                </div>

                <div class="form-group">
                    <label for="description_fr">Description (French) *</label>
                    <textarea name="description_fr" id="description_fr" placeholder="e.g. Description en Français" required></textarea>
                </div>

                <div class="form-group">
                    <label for="description_2">Description 2</label>
                    <textarea name="description_2" id="description_2" placeholder="e.g. Additional Description"></textarea>
                </div>

                <!-- Images -->
                {{-- <div class="form-group">
                    <label for="flag">Upload Flag (For Capital City) *</label>
                    <div class="upload-box" onclick="document.getElementById('flag').click()">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="flag" id="flag" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image | Icon | Thumbnail *</label>
                    <div class="upload-box" onclick="document.getElementById('image').click()">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="image" id="image" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bg_image">Background Image *</label>
                    <div class="upload-box" onclick="document.getElementById('bg_image').click()">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="bg_image" id="bg_image" required>
                    </div>
                </div> --}}

                <div class="form-group">
                    <label for="flag">Upload Flag (For Capital City) *</label>
                    <div class="upload-box" id="upload-box-flag">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="flag" id="flag" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image | Icon | Thumbnail *</label>
                    <div class="upload-box" id="upload-box-image">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="image" id="image" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bg_image">Background Image *</label>
                    <div class="upload-box" id="upload-box-bg_image">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="bg_image" id="bg_image" required>
                    </div>
                </div>

                <!-- Location Details -->
                <div class="form-group">
                    <label for="latitude">Latitude *</label>
                    <input type="number" name="latitude" id="latitude" placeholder="e.g. 37.7749" required>
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude *</label>
                    <input type="number" name="longitude" id="longitude" placeholder="e.g. -122.4194" required>
                </div>

                <div class="form-group">
                    <label for="radius">Radius *</label>
                    <input type="number" name="radius" id="radius" placeholder="e.g. 50" required>
                </div>

                <div class="form-group">
                    <label for="location">Location *</label>
                    <input type="text" name="location" id="location" placeholder="e.g. San Francisco" required>
                </div>

                <!-- Other Details -->
                <div class="form-group">
                    <label for="year">Year *</label>
                    <input type="number" name="year" id="year" placeholder="e.g. 2024" required>
                </div>

                <div class="form-group">
                    <label for="date">Date *</label>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="day">Day *</label>
                    <input type="text" name="day" id="day" placeholder="e.g. Monday" required>
                </div>

                <div class="form-group">
                    <label for="timing">Timing *</label>
                    <input type="text" name="timing" id="timing" placeholder="e.g. 9:00 AM - 5:00 PM" required>
                </div>

                <!-- Contact Information -->
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" placeholder="e.g. example@example.com" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone *</label>
                    <input type="tel" name="phone" id="phone" placeholder="e.g. +123456789" required>
                </div>

                <div class="form-group">
                    <label for="whatsappNum">WhatsApp Number *</label>
                    <input type="tel" name="whatsappNum" id="whatsappNum" placeholder="e.g. +123456789" required>
                </div>

                <div class="form-group">
                    <label for="website">Website *</label>
                    <input type="url" name="website" id="website" placeholder="e.g. https://example.com" required>
                </div>

                {{-- <div class="form-group">
                    <label for="video">Video *</label>
                    <div class="upload-box" onclick="document.getElementById('video').click()">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="video" id="video" required>
                    </div>
                </div> --}}

                <div class="form-group">
                    <label for="video">Video *</label>
                    <div class="upload-box" id="upload-box-video">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <input type="file" name="video" id="video" required>
                    </div>
                </div>

                <!-- Boolean Fields -->
                <div class="form-group">
                    <label for="geo_fencing">Geo Fencing</label>
                    <select name="geo_fencing" id="geo_fencing" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- Gallery Images -->
                <div class="form-group">
                    <label for="gallery_images">Gallery Images *</label>
                    <select name="gallery_status" id="gallery_status" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- Gallery Videos -->
                <div class="form-group">
                    <label for="gallery_videos">Gallery Videos *</label>
                    <select name="vgallery_status" id="vgallery_status" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="has_trail">Has Trail</label>
                    <select name="has_trail" id="has_trail" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="has_360">Has 360</label>
                    <select name="has_360" id="has_360" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- Links -->
                <div class="form-group">
                    <label for="booking_url">Booking URL *</label>
                    <input type="url" name="booking_url" id="booking_url" placeholder="e.g. https://booking.com"
                        required>
                </div>

                <div class="form-group">
                    <label for="registration_link">Registration Link *</label>
                    <input type="url" name="registration_link" id="registration_link"
                        placeholder="e.g. https://register.com" required>
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
                    <button type="submit" class="btn-save">Save</button>
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
            border-color: #007bff;
            background-color: #f0f8ff;
        }

        .upload-box .icon {
            margin-bottom: 10px;
        }

        .upload-box input[type="file"] {
            display: none;
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
        // Add drag-and-drop functionality
        document.querySelectorAll('.upload-box').forEach(box => {
            const input = box.querySelector('input[type="file"]');

            // Handle drag events
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

                if (e.dataTransfer.files.length) {
                    input.files = e.dataTransfer.files;
                    box.querySelector('.text').textContent =
                        `File selected: ${e.dataTransfer.files[0].name}`;
                }
            });

            // Handle file selection via click
            box.addEventListener('click', () => {
                input.click();
            });

            input.addEventListener('change', () => {
                if (input.files.length) {
                    box.querySelector('.text').textContent = `File selected: ${input.files[0].name}`;
                }
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
