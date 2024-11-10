<table class="custom-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($featuredDetails as $detail)
            <tr>
                <td class="title">
                    <img class="featured_banner_icon" src="{{ asset($detail->featured_banner) }}"
                        alt="{{ $detail->title }}">
                    <span>{{ $detail->title }}</span>
                </td>
                <td>
                    <span class="status {{ $detail->status == 1 ? 'active' : 'disabled' }}">
                        {{ $detail->status == 1 ? 'Active' : 'Deactive' }}
                    </span>
                </td>
                <td class="action-btn">
                    <button class="delete-btn" onclick="alert('delete {{ $detail->id }}');">
                        <img src="{{ asset('images/delete-icon.svg') }}" alt="Delete">
                    </button>
                    <button class="edit-btn" onclick="editMenu({{ $detail->id }})">
                        <img src="{{ asset('images/edit-icon.svg') }}" alt="Edit">
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-section">
    <div class="pagination">
        {{ $featuredDetails->appends(request()->except('page'))->links() }}
    </div>
    <div class="record-summary">
        Page {{ $featuredDetails->currentPage() }} of {{ $featuredDetails->lastPage() }}
    </div>
</div>
