@extends('layouts.admin')

@section('title', 'Featured Location')

@section('content')
    <div class="form-header">
        <div class="bread-crumb">
            <span><a href="{{ route('dashboard') }}"><img src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Featured Location</span>
        </div>
        <div class="sub-header">
            <h2>Featured Location</h2>
            <div class="form-actions">
                <button class="btn-save" onclick="window.location.href='{{ route('featured_location.create') }}'">Add New
                    Location</button>
            </div>
        </div>
    </div>

    <div class="table-section">
        <div class="filter-bar">
            <div class="filter">
                <select id="entriesPerPage" onchange="updateEntriesPerPage()">
                    <option value="10">Show 10 Entries</option>
                    <option value="25">Show 25 Entries</option>
                    <option value="50">Show 50 Entries</option>
                    <option value="100">Show 100 Entries</option>
                </select>
            </div>
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search" onkeyup="searchTable()">
            </div>
        </div>

        <div class="table-container" id="table-container">
            @include('partials.featured_table', ['featuredDetails' => $featuredDetails])
        </div>
    </div>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/featured.css') }}">
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to fetch the table content using AJAX
            function fetchTableContent(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    success: function(response) {
                        $('#table-container').html(response);
                        bindPaginationLinks(); // Bind the new pagination links
                    }
                });
            }

            // Update the number of entries per page
            function updateEntriesPerPage() {
                let perPage = $('#entriesPerPage').val();
                let url = "{{ route('featured_location.index') }}" + "?per_page=" + perPage + "&search=" + $(
                    '#search').val();
                fetchTableContent(url);
            }

            // Search functionality
            function searchTable() {
                let search = $('#search').val();
                let url = "{{ route('featured_location.index') }}" + "?search=" + search + "&per_page=" + $(
                    '#entriesPerPage').val();
                fetchTableContent(url);
            }

            // Bind pagination links for AJAX
            function bindPaginationLinks() {
                $(document).off('click', '.pagination a'); // Remove existing bindings
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    let url = $(this).attr('href');
                    fetchTableContent(url);
                });
            }

            // Bind change and keyup events
            $('#entriesPerPage').change(updateEntriesPerPage);
            $('#search').keyup(searchTable);

            // Initial binding for pagination links
            bindPaginationLinks();
        });
    </script>
@endsection
