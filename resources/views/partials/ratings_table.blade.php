@foreach ($ratings as $rating)
    <tr>
        <td>{{ $rating->name }}</td> <!-- User name from the join -->
        <td>{{ $rating->email }}</td> <!-- User email from the join -->
        <td>{{ $rating->rating }}</td>
        <td>{{ $rating->review }}</td>
        <td>{{ $rating->social_id }}</td>
        <td>{{ $rating->created_At }}</td>
    </tr>
@endforeach
