@extends('layouts.admin')

@section('title', 'Add Featured Location')

@section('content')
    <div class="form-header">
        <div class="bread-crumb">
            <span><a href="{{ route('dashboard') }}"><img src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>
                <a onclick="goBack();" style="cursor: pointer;">Featured Location</a>
            </span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Add New Location</span>
        </div>
        <div class="sub-header">
            <h2>Featured Location</h2>
        </div>
    </div>

    <!-- Form Section -->
    <form id="customForm" action="{{ route('featured_location.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="main-form">
            <!-- Title -->
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Title"
                    required>
            </div>

            <!-- Sub Title -->
            <div class="form-group">
                <label for="sub_title">Sub Title *</label>
                <input type="text" name="sub_title" id="sub_title" value="{{ old('sub_title') }}"
                    placeholder="e.g. Sub Title" required>
            </div>

            <!-- Push Welcome Title -->
            <div class="form-group">
                <label for="push_welcome_title">Push Welcome Title *</label>
                <input type="text" name="push_welcome_title" id="push_welcome_title"
                    value="{{ old('push_welcome_title') }}" placeholder="e.g. Push Welcome Title" required>
            </div>

            <!-- Push Notification Body -->
            <div class="form-group">
                <label for="push_body">Push Notification Body *</label>
                <textarea name="push_body" id="push_body" rows="3" placeholder="Enter push notification body" required>{{ old('push_body') }}</textarea>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description *</label>
                <textarea name="description" id="description" rows="5" placeholder="Enter description" required>{{ old('description') }}</textarea>
            </div>

            <!-- Description2 -->
            <div class="form-group">
                <label for="description_2">Description2 *</label>
                <textarea name="description_2" id="description_2" rows="5" placeholder="Enter additional description" required>{{ old('description_2') }}</textarea>
            </div>

            <!-- Description in Spanish -->
            <div class="form-group">
                <label for="description_sp">Description Spanish *</label>
                <textarea name="description_sp" id="description_sp" rows="5" placeholder="Descripción en español" required>{{ old('description_sp') }}</textarea>
            </div>

            <!-- Description in French -->
            <div class="form-group">
                <label for="description_fr">Description French *</label>
                <textarea name="description_fr" id="description_fr" rows="5" placeholder="Description en français" required>{{ old('description_fr') }}</textarea>
            </div>

            <!-- Background Image -->
            <div class="form-group">
                <label for="background_image">Background Image *</label>
                <div class="upload-box" onclick="document.getElementById('background_image').click()"
                    data-input-id="background_image">
                    <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                    <div class="text"><span>Click to upload</span> or drag and drop</div>
                    <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                    <!-- Add 'name' attribute here -->
                    <input type="file" name="background_image" id="background_image" required>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    placeholder="e.g. email@example.com" required>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone *</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                    placeholder="e.g. +1234567890" required maxlength="15">
            </div>

            <!-- WhatsApp Number -->
            <div class="form-group">
                <label for="whatsappNum">WhatsApp Number *</label>
                <input type="tel" name="whatsappNum" id="whatsappNum" value="{{ old('whatsappNum') }}"
                    placeholder="e.g. +1234567890" required maxlength="15">
            </div>

            <!-- Website -->
            <div class="form-group">
                <label for="website">Website Link *</label>
                <input type="url" name="website" id="website" value="{{ old('website') }}"
                    placeholder="www.admin.com" required>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location">Location *</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                    placeholder="e.g. City, Country" required>
            </div>

            <!-- Latitude -->
            <div class="form-group">
                <label for="latitude">Latitude *</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                    placeholder="e.g. 34.0522" required>
            </div>

            <!-- Longitude -->
            <div class="form-group">
                <label for="longitude">Longitude *</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                    placeholder="e.g. -118.2437" required>
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

            <!-- Booking URL -->
            <div class="form-group">
                <label for="booking_url">Booking URL *</label>
                <input type="url" name="booking_url" id="booking_url" value="{{ old('booking_url') }}"
                    placeholder="e.g. https://booking.example.com" required>
            </div>
        </div>

        <div class="form-footer">
            <div class="form-actions">
                <button type="submit" class="btn-save">Save</button>
                <button type="button" class="btn-cancel"
                    onclick="window.location='{{ route('featured_location.index') }}'">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Display success message -->
    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
    <link rel="stylesheet" href="{{ asset('css/featured.css') }}">
    <style>
        .modal-backdrop {
            backdrop-filter: blur(5px);
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
                        fileInput.files = files;
                    }
                });

                // File input change event
                fileInput.addEventListener('change', () => handlePreview(fileInput, box));
            });
        });

        $(document).ready(function() {
            // Show success modal if success message exists
            @if (session('success'))
                $('#successModal').modal('show');
            @endif

            // Show error modal if errors exist
            @if ($errors->any())
                $('#errorModal').modal('show');
            @endif
        });

        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            @endif
        });

        function goBack() {
            if (document.referrer) {
                window.location = document.referrer; // Navigate to the referrer
            } else {
                window.location = '{{ route('dashboard') }}'; // Fallback to dashboard if no referrer
            }
        }
    </script>
@endsection
