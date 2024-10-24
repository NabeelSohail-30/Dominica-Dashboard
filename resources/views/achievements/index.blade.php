@extends('layouts.admin')

@section('title', 'Achievements')

@section('content')
    @csrf
    <!-- Breadcrumb and Header -->
    <div class="form-header">
        <div class="bread-crumb">
            <span><a onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer"><img
                        src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Achievements</span>
        </div>
        <div class="sub-header">
            <h2>Achievements</h2>
            <!-- Action Buttons -->
            <div class="form-actions">
                <button class="btn-save" onclick="window.location.href='{{ route('achievements.create') }}'">
                    Create New Achievement
                </button>
            </div>
        </div>
    </div>

    <!-- Achievements Table -->
    <div class="table-section">
        <div class="filter-bar">
            <!-- Filter by number of entries per page -->
            <div class="filter" data-url="{{ route('achievements.index') }}">
                <div class="filter-text">
                    <select id="entriesPerPage" onchange="updateEntriesPerPage()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>Show 10 Entries</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>Show 25 Entries</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>Show 50 Entries</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>Show 100 Entries</option>
                    </select>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-icon">
                    <img src="{{ asset('images/search-icon.svg') }}" alt="Search Icon">
                </div>
                <input type="text" id="search" placeholder="Search" onkeyup="performSearch()"
                    value="{{ request('search') }}" data-search-url="{{ route('achievements.search') }}">
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container" id="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>
                            Title
                            <a
                                href="{{ route('achievements.index', ['sort' => 'achievement_title', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'per_page' => request('per_page'), 'search' => request('search')]) }} ">
                                <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                            </a>
                        </th>
                        <th>Push Title</th>
                        <th>How To Get There</th>
                        <th>Description</th>
                        <th>Color Image</th>
                        <th>B&W Image</th>
                        <th>Actions</th> <!-- Added actions column for delete button -->
                    </tr>
                </thead>
                <tbody id="achievementsTableBody">
                    @include('partials.achievement_table', ['achievements' => $achievements])
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div class="pagination-section">
            <div class="pagination">
                {{ $achievements->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
            </div>
            <div class="record-summary">
                Page {{ $achievements->currentPage() }} of {{ $achievements->lastPage() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Achievement item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="hideDeleteModal();">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/achievement.css') }}">
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

    <script>
        $(document).ready(function() {
            // Setup CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        });

        function hideDeleteModal() {
            $('#deleteModal').modal('hide');
        }

        let achievementIdToDelete = null;

        function showDeleteModal(achievementId) {
            achievementIdToDelete = achievementId;
            $('#deleteModal').modal('show');
        }

        $('#confirmDelete').click(function() {
            if (achievementIdToDelete) {
                $.ajax({
                    url: '/achievements/' + achievementIdToDelete,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Laravel CSRF token
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
            $('#deleteModal').modal('hide'); // Hide modal on delete action
        });

        function performSearch() {
            const searchValue = document.getElementById('search').value;
            const searchUrl = document.getElementById('search').getAttribute('data-search-url');
            const perPage = document.getElementById('entriesPerPage').value;

            // AJAX request for searching achievements
            $.ajax({
                url: searchUrl,
                type: "GET",
                data: {
                    search: searchValue,
                    per_page: perPage
                },
                success: function(data) {
                    // Update the table body with the returned data
                    $("#achievementsTableBody").html(data);
                    updatePaginationLinks(searchValue); // Update pagination links with the search query
                },
                error: function(xhr) {
                    console.error("Search AJAX error:", xhr);
                },
            });
        }

        function updatePaginationLinks(searchQuery) {
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                const url = new URL(link.href);
                url.searchParams.set('search', searchQuery); // Add search query to the pagination link
                link.href = url.toString();
            });
        }

        function updateEntriesPerPage() {
            const entriesPerPage = document.getElementById("entriesPerPage").value;
            const url = new URL(window.location.href);
            url.searchParams.set("per_page", entriesPerPage);
            window.location.href = url.href; // Reload page with new entries per page
        }
    </script>
@endsection
