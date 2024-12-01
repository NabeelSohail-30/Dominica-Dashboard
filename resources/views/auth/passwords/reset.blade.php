@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
    <form action="{{ route('password.change') }}" method="POST">
        @csrf

        <div class="form-header">
            <div class="bread-crumb">
                <span><a onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer"><img
                            src="{{ asset('images/home-icon.svg') }}" alt="Home"></a></span>
                <span><img src="{{ asset('images/forward-icon.svg') }}" alt=""></span>
                <span>Change Password</span>
            </div>
            <div class="sub-header">
                <h2>Account Settings</h2>
            </div>
        </div>

        <div class="main-form">
            <div class="section main-head">
                <h4>Change Password</h4>
                <p>Update your account password below.</p>
            </div>

            <div class="section form">
                <!-- Current Password -->
                <div class="form-group">
                    <label for="current_password">Current Password *</label>
                    <input type="password" name="current_password" id="current_password"
                        placeholder="Enter current password" required>
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label for="new_password">New Password *</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Enter new password" required>
                </div>

                <!-- Confirm New Password -->
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password *</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                        placeholder="Re-enter new password" required>
                </div>
            </div>
        </div>

        <div class="form-footer">
            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Update Password</button>
            </div>
        </div>
    </form>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Password changed successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Something went wrong. Please try again later.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal handling script -->
    <script>
        @if (session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @elseif (session('error'))
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    </script>
@endsection
