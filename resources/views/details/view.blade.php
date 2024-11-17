@extends('layouts.admin')

@section('title', 'View Detail')

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
                <span>Details</span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>View Details</span>
            </div>
            <div class="sub-header">
                <h2>View Details</h2>
            </div>
        </div>

        <div class="main-form">
            <!-- Text Fields -->
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" name="title" id="title" placeholder="e.g. Listing Title" required
                    value="{{ $details->title }}" disabled>
            </div>

            <div class="form-group">
                <label for="sub_title">Subtitle *</label>
                <input type="text" name="sub_title" id="sub_title" placeholder="e.g. Subtitle" required
                    value="{{ $details->sub_title }}" disabled>
            </div>

            <div class="form-group">
                <label for="push_welcome_title">Push Welcome Title *</label>
                <input type="text" name="push_welcome_title" id="push_welcome_title" placeholder="e.g. Welcome Title"
                    required value="{{ $details->push_welcome_title }}" disabled>
            </div>

            <div class="form-group">
                <label for="push_body">Push Body *</label>
                <textarea name="push_body" id="push_body" placeholder="e.g. Push notification body" required disabled>{{ $details->push_body }}</textarea>
            </div>

            <!-- Descriptions -->
            <div class="form-group">
                <label for="description">Description *</label>
                <textarea name="description" id="description" placeholder="e.g. Description" required disabled>{{ $details->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_sp">Description (Spanish) *</label>
                <textarea name="description_sp" id="description_sp" placeholder="e.g. Descripción en Español" required disabled>{{ $details->description_sp }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_fr">Description (French) *</label>
                <textarea name="description_fr" id="description_fr" placeholder="e.g. Description en Français" required disabled>{{ $details->description_fr }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_2">Description 2</label>
                <textarea name="description_2" id="description_2" placeholder="e.g. Additional Description" disabled>{{ $details->description_2 }}</textarea>
            </div>

            <!-- Images -->
            <div class="form-group">
                <label for="flag">Upload Flag (For Capital City) *</label>
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
                    value="{{ $details->latitude }}" disabled>
            </div>

            <div class="form-group">
                <label for="longitude">Longitude *</label>
                <input type="text" name="longitude" id="longitude" placeholder="e.g. -122.4194" required
                    value="{{ $details->longitude }}" disabled>
            </div>

            <div class="form-group">
                <label for="radius">Radius *</label>
                <input type="number" name="radius" id="radius" placeholder="e.g. 50" required
                    value="{{ $details->radius }}" disabled>
            </div>

            <div class="form-group">
                <label for="location">Location *</label>
                <input type="text" name="location" id="location" placeholder="e.g. San Francisco" required
                    value="{{ $details->location }}" disabled>
            </div>

            <!-- Other Details -->
            <div class="form-group">
                <label for="year">Year *</label>
                <input type="number" name="year" id="year" placeholder="e.g. 2024" required
                    value="{{ $details->year }}" disabled>
            </div>

            <div class="form-group">
                <label for="date">Date *</label>
                <input type="date" name="date" id="date" required value="{{ $details->date }}" disabled>
            </div>

            <div class="form-group">
                <label for="day">Day *</label>
                <input type="text" name="day" id="day" placeholder="e.g. Monday" required
                    value="{{ $details->day }}" disabled>
            </div>

            <div class="form-group">
                <label for="timing">Timing *</label>
                <input type="text" name="timing" id="timing" placeholder="e.g. 9:00 AM - 5:00 PM" required
                    value="{{ $details->timing }}" disabled>
            </div>

            <!-- Contact Information -->
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" name="email" id="email" placeholder="e.g. example@example.com" required
                    value="{{ $details->email }}" disabled>
            </div>

            <div class="form-group">
                <label for="phone">Phone *</label>
                <input type="tel" name="phone" id="phone" placeholder="e.g. +123456789" required
                    value="{{ $details->phone }}" disabled>
            </div>

            <div class="form-group">
                <label for="whatsappNum">WhatsApp Number *</label>
                <input type="tel" name="whatsappNum" id="whatsappNum" placeholder="e.g. +123456789" required
                    value="{{ $details->whatsappNum }}" disabled>
            </div>

            <div class="form-group">
                <label for="website">Website *</label>
                <input type="url" name="website" id="website" placeholder="e.g. https://example.com" required
                    value="{{ $details->website }}" disabled>
            </div>

            <div class="form-group">
                <label for="video">Video *</label>
                <div class="curr-image">
                    @if ($details->video)
                        <video class="video-preview" style="max-width: 200px; margin-top: 10px; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#videoModal" data-src="{{ asset($details->video) }}">
                            <source src="{{ asset($details->video) }}" type="video/mp4">
                        </video>
                    @endif
                </div>
            </div>

            <!-- Boolean Fields as Textboxes -->
            <div class="form-group">
                <label for="geo_fencing">Geo Fencing</label>
                <input type="text" id="geo_fencing" value="{{ $details->geo_fencing ? 'Yes' : 'No' }}" disabled>
            </div>

            <div class="form-group">
                <label for="gallery_status">Gallery Images *</label>
                <input type="text" id="gallery_status" value="{{ $details->gallery_status ? 'Yes' : 'No' }}"
                    disabled>
            </div>

            <div class="form-group">
                <label for="vgallery_status">Gallery Videos *</label>
                <input type="text" id="vgallery_status" value="{{ $details->vgallery_status ? 'Yes' : 'No' }}"
                    disabled>
            </div>

            <div class="form-group">
                <label for="has_trail">Has Trail</label>
                <input type="text" id="has_trail" value="{{ $details->has_trail ? 'Yes' : 'No' }}" disabled>
            </div>

            <div class="form-group">
                <label for="has_360">Has 360</label>
                <input type="text" id="has_360" value="{{ $details->has_360 ? 'Yes' : 'No' }}" disabled>
            </div>

            <!-- Links -->
            <div class="form-group">
                <label for="booking_url">Booking URL *</label>
                <input type="url" name="booking_url" id="booking_url" placeholder="e.g. https://booking.com"
                    required value="{{ $details->booking_url }}" disabled>
            </div>

            <div class="form-group">
                <label for="registration_link">Registration Link *</label>
                <input type="url" name="registration_link" id="registration_link"
                    placeholder="e.g. https://register.com" required value="{{ $details->registration_link }}" disabled>
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
    <script>
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
    </script>
@endsection
