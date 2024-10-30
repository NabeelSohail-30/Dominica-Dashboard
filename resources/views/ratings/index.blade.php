@extends('layouts.admin')

@section('title', 'Ratings')

@section('content')
    @csrf
    <!-- Breadcrumb and Header -->
    <div class="form-header">
        <div class="bread-crumb">
            <span><a onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer"><img
                        src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>All Comments</span>
        </div>
        <div class="sub-header">
            <h2>All Comments</h2>
        </div>
    </div>

    <!-- Filter, Search Bar, and Table Section -->
    <div class="table-section">
        <!-- Filter by number of entries per page -->
        <div class="filter-bar">
            <div class="filter" data-url="{{ route('ratings.index') }}">
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
                    value="{{ request('search') }}" data-search-url="{{ route('ratings.search') }}">
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container" id="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Social ID</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody id="ratingsTableBody">
                    @foreach ($ratings as $rating)
                        <tr>
                            <td>{{ $rating->name }}</td> <!-- User name from the join -->
                            <td>{{ $rating->email }}</td> <!-- User email from the join -->
                            <td>{{ $rating->rating }}</td>
                            <td>{{ $rating->review }}</td>
                            <td>{{ $rating->social_id }}</td>
                            <td>{{ $rating->created_At }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-section">
            <div class="pagination">
                {{ $ratings->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
            </div>
            <div class="record-summary">
                Page {{ $ratings->currentPage() }} of {{ $ratings->lastPage() }}
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

        .table-section {
            margin-top: 120px;
            padding: 32px;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // AJAX Setup for CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function performSearch() {
            const searchValue = $('#search').val();
            const searchUrl = $('#search').data('search-url');
            const perPage = $('#entriesPerPage').val();

            $.ajax({
                url: searchUrl,
                type: 'GET',
                data: {
                    search: searchValue,
                    per_page: perPage
                },
                success: function(data) {
                    $('#ratingsTableBody').html(data);
                },
                error: function(xhr) {
                    console.error('Search error:', xhr);
                }
            });
        }

        function updateEntriesPerPage() {
            const entriesPerPage = $('#entriesPerPage').val();
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', entriesPerPage);
            window.location.href = url.href;
        }
    </script>
@endsection
