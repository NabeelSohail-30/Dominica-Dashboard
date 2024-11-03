@extends('layouts.admin')

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
                <button class="btn-save" onclick="window.location.href='{{ route('achievements.create') }}'">Add New
                    Location</button>
            </div>
        </div>
    </div>

    <div class="table-section">
        <div class="filter-bar">
            <select id="entriesPerPage" onchange="updateTable()">
                <option value="10">Show 10 Entries</option>
                <option value="25">Show 25 Entries</option>
                <option value="50">Show 50 Entries</option>
                <option value="100">Show 100 Entries</option>
            </select>
            <input type="text" id="search" placeholder="Search" onkeyup="updateTable()">
        </div>

        <div class="table-container" id="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Banner</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="menuTableBody">
                    @include('partials.featured_table', ['featuredDetails' => $featuredDetails])
                </tbody>
            </table>
        </div>

        <div class="pagination-section" id="pagination-section">
            {{ $featuredDetails->links('pagination::bootstrap-4') }}
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
    <script>
        function updateTable(page = 1) {
            const perPage = $('#entriesPerPage').val();
            const search = $('#search').val();

            $.ajax({
                url: "{{ route('featured_location.index') }}",
                type: "GET",
                data: {
                    search: search,
                    per_page: perPage,
                    page: page
                },
                success: function(data) {
                    $('#menuTableBody').html(data); // Load new table rows
                    updatePaginationLinks(search, perPage);
                },
                error: function(xhr) {
                    console.error("Error fetching data:", xhr);
                }
            });
        }

        function updatePaginationLinks(search, perPage) {
            $('#pagination-section .pagination a').each(function() {
                let url = new URL(this.href);
                url.searchParams.set('search', search);
                url.searchParams.set('per_page', perPage);
                this.href = url;
            });
        }

        $(document).on('click', '#pagination-section .pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            const page = new URL(url).searchParams.get('page');
            updateTable(page);
        });
    </script>
@endsection
