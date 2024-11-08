@extends('layouts.admin')

@section('title', 'Hike Details')

@section('content')
    <div class="form-header">
        <div class="bread-crumb">
            <span><a href="{{ route('dashboard') }}"><img src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Hike Details</span>
        </div>
        <div class="sub-header">
            <h2>Hike Details</h2>
        </div>
    </div>

    <div class="table-section">
        <div class="filter-bar">
            <div class="filter">
                <select id="entriesPerPage">
                    <option value="10">Show 10 Entries</option>
                    <option value="25">Show 25 Entries</option>
                    <option value="50">Show 50 Entries</option>
                    <option value="100">Show 100 Entries</option>
                </select>
            </div>
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search">
            </div>
        </div>

        <div class="table-container" id="table-container">
            @include('partials.hike_table', ['registrations' => $registrations])
        </div>
    </div>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hike.css') }}">
    <style>
        .modal-backdrop {
            backdrop-filter: blur(5px);
        }

        .table-section {
            margin-top: 120px;
            padding: 32px;
        }

        .pagination-section {
            margin-top: 15px;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // AJAX setup for loading table data
        function loadTable(page = 1) {
            $.ajax({
                url: "{{ route('hike.index') }}",
                type: "GET",
                data: {
                    search: $('#search').val(),
                    sort: "{{ request('sort', 'first_name') }}",
                    order: "{{ request('order', 'asc') }}",
                    entriesPerPage: $('#entriesPerPage').val(),
                    page: page // Include the page parameter for pagination
                },
                success: function(response) {
                    $('#table-container').html(response);
                }
            });
        }

        // Event listeners for search, pagination, and sorting
        $('#search').on('keyup', function() {
            loadTable();
        });

        $('#entriesPerPage').on('change', function() {
            loadTable();
        });

        $(document).on('click', '.sortable', function(e) {
            e.preventDefault();
            let sort = $(this).data('sort');
            let order = $(this).data('order');
            $.ajax({
                url: "{{ route('hike.index') }}",
                data: {
                    search: $('#search').val(),
                    sort: sort,
                    order: order,
                    entriesPerPage: $('#entriesPerPage').val()
                },
                success: function(response) {
                    $('#table-container').html(response);
                }
            });
        });

        // Event listener for pagination links
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            loadTable(page); // Call loadTable with the page number
        });
    </script>

@endsection
