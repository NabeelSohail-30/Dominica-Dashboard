@foreach ($featuredDetails as $detail)
<tr>
    <td>{{ $detail->title }}</td>
    <td><img src="{{ $detail->featured_banner }}" alt="Banner" style="max-width: 100px;"></td>
    <td>{{ $detail->status }}</td>
    <td>
        <button class="btn btn-primary">Edit</button>
        <button class="btn btn-danger">Delete</button>
    </td>
</tr>
@endforeach