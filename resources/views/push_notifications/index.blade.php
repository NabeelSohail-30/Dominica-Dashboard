@extends('layouts.admin')

@section('title', 'Push Notification')

@section('content')
    <form action="{{ route('push_notifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-header">
            <div class="bread-crumb">
                <span><a onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer"><img
                            src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Push Notifications</span>
            </div>
            <div class="sub-header">
                <h2>Push Notifications</h2>
                <!-- Action Buttons -->
                <div class="form-actions">
                    <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Update</button>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="main-form">
            <div class="section form">
                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        placeholder="e.g. About Title" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <div class="form-text">
                        <label for="description">Description *</label>
                        <span>Write a short description here.</span>
                    </div>
                    <textarea name="description" id="description" rows="5" placeholder="Enter description" required>{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
    </form>

    <!-- Custom Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
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

    <div class="table-section">
        <div class="filter-bar">
            <div class="filter" data-url="{{ route('push_notifications.index') }}">
                <div class="filter-text">
                    <select id="entriesPerPage" onchange="updateEntriesPerPage()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>Show 10 Entries</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>Show 25 Entries</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>Show 50 Entries</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>Show 100 Entries</option>
                    </select>
                </div>
            </div>

            <div class="search-bar">
                <div class="search-icon">
                    <img src="{{ asset('images/search-icon.svg') }}" alt="Search Icon">
                </div>
                <input type="text" id="search" placeholder="Search" onkeyup="performSearch()"
                    data-search-url="{{ route('push_notifications.search') }}">
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container" id="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="sno">
                            S.No
                            <a
                                href="{{ route('push_notifications.index', ['sort' => 'id', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'per_page' => request('per_page')]) }}">
                                <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                            </a>
                        </th>
                        <th class="title">
                            Title
                            <a
                                href="{{ route('push_notifications.index', ['sort' => 'title', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'per_page' => request('per_page')]) }}">
                                <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                            </a>
                        </th>
                        <th class="desc">
                            Description
                            <a
                                href="{{ route('push_notifications.index', ['sort' => 'description', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'per_page' => request('per_page')]) }}">
                                <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                            </a>
                        </th>
                        <th class="time">
                            Time
                            <a
                                href="{{ route('push_notifications.index', ['sort' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'per_page' => request('per_page')]) }}">
                                <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody id="notificationsTableBody">
                    @include('partials.push_notification_table', ['notifications' => $notifications])
                </tbody>
            </table>

        </div>

        <!-- Pagination Section -->
        <div class="pagination-section">
            <div class="pagination">
                {{ $notifications->appends(request()->all())->links('pagination::bootstrap-4') }}
            </div>
            <div class="record-summary">
                Page {{ $notifications->currentPage() }} of {{ $notifications->lastPage() }}
            </div>
        </div>
    </div>

@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/push_notification.css') }}">
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
    </style>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @if (session('success'))
        <script>
            // Show modal when success message exists
            var successModal = new bootstrap.Modal(document.getElementById('successModal'), {});
            successModal.show();
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // Setup CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // Search functionality
            $("#search").on("keyup", function() {
                var searchTerm = $(this).val();
                var searchUrl = "/push-notifications/search"; // Adjust URL if necessary

                // AJAX request
                $.ajax({
                    url: searchUrl,
                    type: "GET",
                    data: {
                        search: searchTerm
                    },
                    success: function(data) {
                        // Update the table body with the returned data
                        $("#notificationsTableBody").html(data);
                    },
                    error: function(xhr) {
                        console.error("Search AJAX error:", xhr);
                    },
                });
            });
        });

        function updateEntriesPerPage() {
            const entriesPerPage = document.getElementById("entriesPerPage").value;
            const url = new URL(window.location.href);
            url.searchParams.set("per_page", entriesPerPage);
            window.location.href = url.href;
        }
    </script>
@endsection
