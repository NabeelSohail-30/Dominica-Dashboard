@foreach ($menus as $menu)
    <tr>
        <td>
            <div class="menu-info">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->title }}">
                <span>{{ $menu->title }}</span>
            </div>
        </td>
        <td>
            <span class="status {{ $menu->status == 1 ? 'active' : 'disabled' }}">
                {{ $menu->status == 1 ? 'Active' : 'Deactive' }}
            </span>
        </td>
        <td class="action-btn">
            <button class="edit-btn" onclick="editMenu({{ $menu->id }})" data-tooltip="Edit">
                <img src="{{ asset('images/edit-icon.svg') }}" alt="Edit">
            </button>
            <button class="view-btn" data-tooltip="View"
                onclick="window.location='{{ route('listing', ['id' => $menu->id]) }}';">
                <img src="{{ asset('images/view-icon.svg') }}" alt="View">
            </button>
        </td>

    </tr>
@endforeach

{{-- <!-- Add the pagination links here -->
<div class="pagination-section">
    {{ $menus->links('pagination::bootstrap-4') }}
</div> --}}
