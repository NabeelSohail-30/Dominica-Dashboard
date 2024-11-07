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
            <th>Expected Completion Time</th>
            <th>Phone Number</th>
            <th>Is Active</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registrations as $registration)
            <tr>
                <td>{{ $registration->first_name }}</td>
                <td>{{ $registration->last_name }}</td>
                <td>{{ $registration->expected_completion_datetime }}</td>
                <td>{{ $registration->phone_number }}</td>
                <td>{{ $registration->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <button class="view-btn" data-tooltip="View" onclick="alert('{{ $registration->id }}')">
                        <img src="{{ asset('images/view-icon.svg') }}" alt="View">
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
