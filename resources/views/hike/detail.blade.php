@extends('layouts.admin')

@section('title', 'Hike Details')

@section('content')
    <div class="form-header">
        <div class="bread-crumb">
            <span><a href="{{ route('dashboard') }}"><img src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Hike Details</span>
            <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
            <span>Hike Location Tracking</span>
        </div>
        <div class="sub-header">
            <h2>Hike Location Tracking</h2>
        </div>
    </div>

    <div class="table-section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hike Information</h4>
            </div>
            <div class="card-body">
                <div class="card-body-inner-box">
                    <p><strong>First Name:</strong> {{ $hikeDetails->first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $hikeDetails->last_name }}</p>
                    <p><strong>Phone Number:</strong> {{ $hikeDetails->phone_number }}</p>
                    <p><strong>Current Address:</strong> {{ $hikeDetails->current_address }}</p>
                </div>

                <div class="card-body-inner-box">
                    <p><strong>Intended Hike:</strong> {{ $hikeDetails->intended_hike }}</p>
                    <p><strong>Status:</strong> {{ $hikeDetails->status }}</p>
                    <p><strong>Next of Kin Name:</strong> {{ $hikeDetails->next_of_kin_name }}</p>
                    <p><strong>Next of Kin Contact Number:</strong> {{ $hikeDetails->next_of_kin_contact_number }}</p>
                </div>
            </div>
        </div>

        <h4>Location Tracking</h4>
        @if ($locationTracking->isNotEmpty())
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Tracked At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locationTracking as $location)
                        <tr>
                            <td>{{ $location->latitude }}</td>
                            <td>{{ $location->longitude }}</td>
                            <td>{{ $location->tracked_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination-section">
                <div class="pagination">
                    {{ $locationTracking->links('pagination::bootstrap-4') }}
                </div>
                <div class="record-summary">
                    Page {{ $locationTracking->currentPage() }} of {{ $locationTracking->lastPage() }}
                </div>
            </div>
        @else
            <p>No location tracking data available.</p>
        @endif

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

        .card {
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f5f5f5;
            padding: 15px;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .card-body-inner-box {
            width: 50%;
            padding: 10px;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
