@extends('layouts.admin')

@section('title', 'Hike Details')

<body>
    <div class="container mt-5">
        <h1>Hike Details with Location Tracking</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Registration ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Location Tracking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hikeDetails as $hike)
                    <tr>
                        <td>{{ $hike->id }}</td>
                        <td>{{ $hike->first_name }}</td>
                        <td>{{ $hike->last_name }}</td>
                        <td>{{ $hike->phone_number }}</td>
                        <td>
                            @if ($hike->locationTracking->isNotEmpty())
                                <ul>
                                    @foreach ($hike->locationTracking as $location)
                                        <li>
                                            Latitude: {{ $location->latitude }},
                                            Longitude: {{ $location->longitude }},
                                            Tracked At: {{ $location->tracked_at }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No location tracking data available.</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
