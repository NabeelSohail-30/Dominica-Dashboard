@extends('layouts.admin')

@section('title', 'Edit Achievement')

@section('content')
    <div class="container">
        <div class="form-header">
            <div class="bread-crumb">
                <span><a onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer"><img
                            src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Edit Achievement</span>
            </div>
            <div class="sub-header">
                <h2>Edit Achievement</h2>
            </div>
        </div>

        <!-- Form Section -->
        <form id="achievementForm" action="{{ route('achievements.update', $achievement->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="main-form">
                <div class="form-group">
                    <label for="achievement_title">Title *</label>
                    <input type="text" name="achievement_title" id="achievement_title"
                        value="{{ old('achievement_title', $achievement->achievement_title) }}"
                        placeholder="e.g. Achievement Title" required>
                </div>

                <div class="form-group">
                    <label for="achievement_push_title">Push Notification *</label>
                    <input type="text" name="achievement_push_title" id="achievement_push_title"
                        value="{{ old('achievement_push_title', $achievement->achievement_push_title) }}"
                        placeholder="e.g. Push Notification Title" required>
                </div>

                <div class="form-group">
                    <label for="achievement_how_to_get_here">How to Get There *</label>
                    <input type="text" name="achievement_how_to_get_here" id="achievement_how_to_get_here"
                        value="{{ old('achievement_how_to_get_here', $achievement->achievement_how_to_get_here) }}"
                        placeholder="e.g. How to get there" required>
                </div>

                <div class="form-group">
                    <label for="achievement_lat">Latitude</label>
                    <input type="number" name="achievement_lat" id="achievement_lat"
                        value="{{ old('achievement_lat', $achievement->achievement_lat) }}">
                </div>

                <div class="form-group">
                    <label for="achievement_long">Longitude</label>
                    <input type="number" name="achievement_long" id="achievement_long"
                        value="{{ old('achievement_long', $achievement->achievement_long) }}">
                </div>

                <div class="form-group">
                    <label for="radius">Radius</label>
                    <input type="number" name="radius" id="radius" value="{{ old('radius', $achievement->radius) }}">
                </div>

                <div class="form-group">
                    <label for="achievement_description">Description *</label>
                    <textarea name="achievement_description" id="achievement_description" rows="5"
                        placeholder="Enter achievement description" required>{{ old('achievement_description', $achievement->achievement_description) }}</textarea>
                </div>

                <!-- Color Image -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="achievement_image_color">Color Image *</label>
                    </div>
                    <div class="form-control">
                        <div class="upload-box" onclick="document.getElementById('achievement_image_color').click()">
                            <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                            <div class="text"><span>Click to upload</span> or drag and drop</div>
                            <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                            <!-- File input -->
                            <input type="file" name="achievement_image_color" id="achievement_image_color" required>
                        </div>

                        <!-- Current Image Preview with Modal Trigger -->
                        <div class="curr-image">
                            @if ($achievement->achievement_image_color)
                                <img src="{{ asset($achievement->achievement_image_color) }}"
                                    alt="{{ $achievement->title }}" class="img-preview"
                                    onclick="showImageModal('{{ asset($achievement->achievement_image_color) }}')"
                                    style="cursor:pointer;">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Black & White Image -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="achievement_image_bw">B&W Image *</label>
                    </div>
                    <div class="form-control">
                        <div class="upload-box" onclick="document.getElementById('achievement_image_bw').click()">
                            <div class="icon"><img src="{{ asset('images/upload-cloud.svg') }}" alt=""></div>
                            <div class="text"><span>Click to upload</span> or drag and drop</div>
                            <div class="subtext">Supports: PNG, JPG, JPEG, WEBP</div>
                            <!-- File input -->
                            <input type="file" name="achievement_image_bw" id="achievement_image_bw" required>
                        </div>

                        <!-- Current Image Preview with Modal Trigger -->
                        <div class="curr-image">
                            @if ($achievement->achievement_image_bw)
                                <img src="{{ asset($achievement->achievement_image_bw) }}" alt="{{ $achievement->title }}"
                                    class="img-preview"
                                    onclick="showImageModal('{{ asset($achievement->achievement_image_bw) }}')"
                                    style="cursor:pointer;">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Manual -->
                <div class="form-group">
                    <label for="manual">Manual</label>
                    <select name="manual" id="manual">
                        <option value="1" {{ $achievement->manual == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $achievement->manual == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="achievement_status">Status</label>
                    <select name="achievement_status" id="achievement_status">
                        <option value="1" {{ $achievement->achievement_status == 1 ? 'selected' : '' }}>Active
                        </option>
                        <option value="0" {{ $achievement->achievement_status == 0 ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-footer">
                <div class="form-actions">
                    <button type="submit" class="btn-save">Update</button>
                    <button type="button" class="btn-cancel"
                        onclick="window.location='{{ route('achievements.index') }}'">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    @include('partials.success_modal')
    @include('partials.error_modal')

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Image Preview" class="img-fluid">
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

    <script>
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

        // Function to update the modal's image dynamically
        function showImageModal(imageSrc) {
            var modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
            myModal.show();
        }
    </script>
@endsection