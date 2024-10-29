@foreach ($achievements as $achievement)
    <tr>
        <td>{{ $achievement->achievement_title }}</td>
        <td>{{ $achievement->achievement_push_title }}</td>
        <td>{{ $achievement->achievement_how_to_get_here }}</td>
        <td>{{ $achievement->achievement_description }}</td>
        <td>
            <img src="{{ asset($achievement->achievement_image_color) }}" alt="Color Image" width="50">
        </td>
        <td>
            <img src="{{ asset($achievement->achievement_image_bw) }}" alt="B&W Image" width="50">
        </td>
        <td class="action-btn">
            <button class="edit-btn" onclick="window.location.href='{{ route('achievements.edit', $achievement->id) }}'"
                data-tooltip="Edit">
                <img src="{{ asset('images/edit-icon.svg') }}" alt="Edit">
            </button>
            <button class="delete-btn" onclick="showDeleteModal({{ $achievement->id }})" data-tooltip="Delete">
                <img src="{{ asset('images/delete-icon.svg') }}" alt="Delete">
            </button>

        </td>
    </tr>
@endforeach
