@foreach ($notifications as $notification)
    <tr>
        <td>{{ $notification->id }}</td>
        <td>{{ $notification->title }}</td>
        <td>{{ $notification->description }}</td>
        <td>{{ $notification->created_at }}</td>
    </tr>
@endforeach
