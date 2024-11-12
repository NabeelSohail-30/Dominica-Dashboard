@extends('layouts.admin')

@section('title', 'Details')

@section('content')
    <div class="form-header">
        <div class="bread-crumb">
            <span><a href="{{ route('dashboard') }}"><img src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Menu</span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Listing</span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Details</span>
        </div>
        <div class="sub-header">
            <h2>Details</h2>
        </div>
    </div>

    <div class="table-section">
        <div class="filter-bar">
            <div class="filter">
                <div class="filter-text">
                    <select id="entriesPerPage">
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
            @if ($details->isEmpty())
                <p>No details found for this menu.</p>
            @else
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $details)
                            <tr>
                                <td>
                                    <div class="menu-info">
                                        <img src="{{ asset($details->image) }}" alt="{{ $details->title }}">
                                        <span>{{ $details->title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="status {{ $details->status == 1 ? 'active' : 'disabled' }}">
                                        {{ $details->status == 1 ? 'Active' : 'Deactive' }}
                                    </span>
                                </td>
                                <td class="action-btn">
                                    <button class="edit-btn" data-tooltip="Edit">
                                        <img src="{{ asset('images/edit-icon.svg') }}" alt="Edit">
                                    </button>
                                    <button class="view-btn" data-tooltip="View">
                                        <img src="{{ asset('images/view-icon.svg') }}" alt="View">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="pagination-section">
            <div class="pagination">
            </div>
            <div class="record-summary">
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
@endsection
