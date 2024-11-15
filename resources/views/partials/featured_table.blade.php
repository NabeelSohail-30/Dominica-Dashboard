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
                    <form action="{{ route('featured_location.destroy', $detail->id) }}" method="POST"
                        style="width: auto">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn">
                            <img src="{{ asset('images/delete-icon.svg') }}" alt="Delete">
                        </button>
                    </form>
                    <button class="edit-btn"
                        onclick="window.location.href='{{ route('featured_location.edit', $detail->id) }}'">
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
