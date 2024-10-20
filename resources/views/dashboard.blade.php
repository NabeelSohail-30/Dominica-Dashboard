@extends('layouts.admin')

@section('content')
    <div class="header-section">
        <div class="welcome">
            <div class="welcome-text">
                Welcome back, {{ Auth::user()->name }}
            </div>
            <div class="welcome-sub-text">Update, manage and forecast your dominica adventures app data.</div>
        </div>
        {{-- <div class="cta">
            <a href="" class="export-btn">Export</a>
            <a href="" class="download-app-btn">Share</a>
        </div> --}}
    </div>

    <div class="alert">
        <div class="alert-msg">Please ensure all adventure place details are up to date for accurate display in the mobile
            app</div>
        <div class="close-icon">
            <a href="#" onclick="closeAlert();">
                <img src="{{ asset('images/close-icon.svg') }}" alt="Close Icon">
            </a>

        </div>
    </div>

    <div class="insights">
        <div class="insight-card">
            <div class="insight-title">Total Events</div>
            <div class="insight-value">2,420</div>
        </div>
        <div class="insight-card">
            <div class="insight-title">Total Events</div>
            <div class="insight-value">2,420</div>
        </div>
        <div class="insight-card">
            <div class="insight-title">Total Events</div>
            <div class="insight-value">2,420</div>
        </div>
        <div class="insight-card">
            <div class="insight-title">Total Events</div>
            <div class="insight-value">2,420</div>
        </div>

    </div>

    <div class="table-section">
        <div class="filter-bar">
            <div class="filter" data-url="{{ route('dashboard') }}">
                {{-- <div class="filter-icon">
                    <img src="{{ asset('images/filter-icon.svg') }}" alt="Filter Icon">
                </div> --}}

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
                <input type="text" id="search" placeholder="Search" data-search-url="{{ route('menu.search') }}">
            </div>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>
                            Menu Title
                            <a
                                href="{{ route('dashboard', ['sort' => 'title', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'per_page' => request('per_page')]) }}">
                                <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                            </a>
                        </th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody id="menuTableBody">
                    @include('partials.menu_table', ['menus' => $menus]) <!-- Initially load the data -->
                </tbody>
            </table>
        </div>

        <div class="pagination-section">
            <div class="pagination">
                {{ $menus->appends(['search' => request('search'), 'sort' => request('sort'), 'order' => request('order'), 'per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
            </div>
            <div class="record-summary">
                Page {{ $menus->currentPage() }} of {{ $menus->lastPage() }}
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
