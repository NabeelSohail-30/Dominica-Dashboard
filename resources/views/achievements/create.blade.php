@extends('layouts.admin')

@section('title', 'Achievements')

@section('content')
    <div class="container">
        <div class="form-header">
            <div class="bread-crumb">
                <span><a onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer"><img
                            src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>
                    <a onclick="goBack();" style="cursor: pointer;">Achievements</a>
                </span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>New Achievement</span>
            </div>
            <div class="sub-header">
                <h2>Add Achievement</h2>
            </div>
        </div>

        <!-- Form Section -->
        <form id="achievementForm" action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="main-form">
                <div class="form-group">
                    <label for="achievement_title">Title *</label>
                    <input type="text" name="achievement_title" id="achievement_title"
                        value="{{ old('achievement_title') }}" placeholder="e.g. Achievement Title" required>
                </div>

                <div class="form-group">
                    <label for="achievement_push_title">Push Notification *</label>
                    <input type="text" name="achievement_push_title" id="achievement_push_title"
                        value="{{ old('achievement_push_title') }}" placeholder="e.g. Push Notification Title" required>
                </div>

                <div class="form-group">
                    <label for="achievement_how_to_get_here">How to Get There *</label>
                    <input type="text" name="achievement_how_to_get_here" id="achievement_how_to_get_here"
                        value="{{ old('achievement_how_to_get_here') }}" placeholder="e.g. How to get there" required>
                </div>

                <div class="form-group">
                    <label for="achievement_lat">Latitude</label>
                    <input type="number" name="achievement_lat" id="achievement_lat" value="0.0">
                </div>

                <div class="form-group">
                    <label for="achievement_long">Longitude</label>
                    <input type="number" name="achievement_long" id="achievement_long" value="0.0">
                </div>

                <div class="form-group">
                    <label for="radius">Radius</label>
                    <input type="number" name="radius" id="radius" value="20">
                </div>

                <div class="form-group">
                    <label for="achievement_description">Description *</label>
                    <textarea name="achievement_description" id="achievement_description" rows="5"
                        placeholder="Enter achievement description" required>{{ old('achievement_description') }}</textarea>
                </div>

                <!-- Color Image -->
                <div class="form-group">
                    <label for="achievement_image_color">Color Image *</label>
                    <div class="upload-box" id="color-image-drop-area"
                        onclick="document.getElementById('achievement_image_color').click()"
                        ondragover="handleDragOver(event)" ondrop="handleFileDrop(event, 'achievement_image_color')">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                        <input type="file" name="achievement_image_color" id="achievement_image_color" required>
                    </div>
                    <div id="color-image-preview" class="image-preview"></div> <!-- For previewing the uploaded file -->
                </div>

                <!-- Black & White Image -->
                <div class="form-group">
                    <label for="achievement_image_bw">B&W Image *</label>
                    <div class="upload-box" id="bw-image-drop-area"
                        onclick="document.getElementById('achievement_image_bw').click()" ondragover="handleDragOver(event)"
                        ondrop="handleFileDrop(event, 'achievement_image_bw')">
                        <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                        <div class="text"><span>Click to upload</span> or drag and drop</div>
                        <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                        <input type="file" name="achievement_image_bw" id="achievement_image_bw" required>
                    </div>
                    <div id="bw-image-preview" class="image-preview"></div> <!-- For previewing the uploaded file -->
                </div>


                <!-- Manual -->
                <div class="form-group">
                    <label for="manual">Manual</label>
                    <select name="manual" id="manual">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="achievement_status">Status</label>
                    <select name="achievement_status" id="achievement_status">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-footer">
                <div class="form-actions">
                    <button type="submit" class="btn-save">Save</button>
                    <button type="button" class="btn-cancel"
                        onclick="window.location='{{ route('achievements.index') }}'">Cancel</button>
                </div>
            </div>
        </form>
    </div>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
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

        .upload-box.dragging {
            border-color: #007bff;
            background-color: #e9f5ff;
        }

        .image-preview img {
            margin-top: 10px;
            max-height: 150px;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Prevent default behavior for drag events
        function handleDragOver(event) {
            event.preventDefault();
            event.stopPropagation();
            event.target.classList.add('dragging'); // Add a visual effect (optional)
        }

        // Handle the drop event
        function handleFileDrop(event, inputId) {
            event.preventDefault();
            event.stopPropagation();
            event.target.classList.remove('dragging'); // Remove visual effect

            const inputFile = document.getElementById(inputId);
            const files = event.dataTransfer.files;

            if (files.length > 0) {
                inputFile.files = files; // Assign dropped files to the file input

                // Optionally, preview the uploaded file
                const previewId = inputId === 'achievement_image_color' ? 'color-image-preview' : 'bw-image-preview';
                previewFile(files[0], previewId);
            }
        }

        // Preview uploaded image
        function previewFile(file, previewId) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById(previewId);
                previewContainer.innerHTML =
                    `<img src="${e.target.result}" alt="Preview" style="max-width: 100%; height: auto;">`;
            };
            reader.readAsDataURL(file);
        }

        $(document).ready(function() {
            // Show success modal if success message exists
            @if (session('success'))
                $('#successModal').modal('show');
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
