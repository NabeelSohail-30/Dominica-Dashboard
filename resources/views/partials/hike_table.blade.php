<table class="custom-table">
    <thead>
        <tr>
            <th>
                First Name
                <a href="javascript:void(0);" class="sortable" data-sort="first_name"
                    data-order="{{ request('order') === 'asc' ? 'desc' : 'asc' }}">
                    <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                </a>
            </th>
            <th>
                Last Name
                <a href="javascript:void(0);" class="sortable" data-sort="last_name"
                    data-order="{{ request('order') === 'asc' ? 'desc' : 'asc' }}">
                    <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                </a>
            </th>
            <th>Expected Completion Time <a href="javascript:void(0);" class="sortable"
                    data-sort="expected_completion_datetime"
                    data-order="{{ request('order') === 'asc' ? 'desc' : 'asc' }}">
                    <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                </a></th>
            <th>Estimated Start Date Time <a href="javascript:void(0);" class="sortable"
                    data-sort="estimated_start_datetime" data-order="{{ request('order') === 'asc' ? 'desc' : 'asc' }}">
                    <img src="{{ asset('images/sort-icon.svg') }}" alt="Sort Icon">
                </a></th>
            <th>Phone Number</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registrations as $registration)
            <tr>
                <td>{{ $registration->first_name }}</td>
                <td>{{ $registration->last_name }}</td>
                <td>{{ $registration->expected_completion_datetime }}</td>
                <td>{{ $registration->estimated_start_datetime }}</td>
                <td>{{ $registration->phone_number }}</td>
                <td>
                    <button class="view-btn" data-tooltip="View"
                        onclick="window.location.href='{{ route('hike.detail', ['id' => $registration->id]) }}'">
                        <img src="{{ asset('images/view-icon.svg') }}" alt="View">
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Controls -->
<div class="pagination-section">
    <div class="pagination">
        {{ $registrations->withQueryString()->links('pagination::bootstrap-4') }}
    </div>
    <div class="record-summary">
        Page {{ $registrations->currentPage() }} of {{ $registrations->lastPage() }}
    </div>
</div>
