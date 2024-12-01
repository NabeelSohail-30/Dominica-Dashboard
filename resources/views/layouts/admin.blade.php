<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Admin Dashboard</title>

    <!-- Custom Admin Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @yield('custom_css')
</head>

<body>
    <div class="app">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-title">
                <div class="left">
                    <div class="icon"><a onclick="window.location='{{ route('dashboard') }}';"
                            style="cursor: pointer;"><img src="{{ asset('images/app-icon.svg') }}" alt=""></a>
                    </div>
                    <div class="title" onclick="window.location='{{ route('dashboard') }}';" style="cursor: pointer;">
                        Explore Dominica</div>
                </div>
                <div class="right">
                    <div class="slider-icon"><a href="#"><img src="{{ asset('images/slider-icon.svg') }}"
                                alt="" class="caret"></a></div>
                </div>
            </div>
            <div class="sidebar-main">
                <div class="sidebar-main-head">
                    {{-- <div class="search">
                        <div class="search-container">
                            <span class="search-icon"><img src="{{ asset('images/search-icon.svg') }}"
                                    alt=""></span>
                            <input type="text" placeholder="Search..." class="search-input">
                            <span class="search-shortcut">⌘K</span>
                        </div>
                    </div> --}}
                    <ul class="menu-list ">
                        <li class="menu-item" onclick="window.location='{{ route('dashboard') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/home-line.svg') }}" alt=""> Dashboard
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('hike.index') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/hike-icon.svg') }}" alt=""> Hike Details
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('featured_location.index') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/feature-side-icon.svg') }}" alt=""> Featured Locations
                        </li>

                        <!-- App Menus with Submenu -->
                        <li class="menu-item has-submenu">
                            <img src="{{ asset('images/app-side-icon.svg') }}" alt=""> App Menus
                            <span class="submenu-icon">
                                <img src="{{ asset('images/caret-right.svg') }}" alt="">
                            </span>
                            <div class="submenu">
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(1)) }}">About Us</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(2)) }}">Explore Dominica</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(3)) }}">Aqua Tourism Pillar</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(4)) }}">Must See Sites</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(5)) }}">Weather</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(6)) }}">Events Pillar</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(7)) }}">Small Tourism
                                    Enterprises</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(8)) }}">Emergency Number</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(9)) }}">Aerial Views</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(10)) }}">Plan Your Hike</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(11)) }}">Guides/Tour Guides</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(12)) }}">Restaurants</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(13)) }}">Walking Tour</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(15)) }}">Adventure Tourism
                                    Pillar.</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(16)) }}">Local Businesses</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(17)) }}">Lodging</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(19)) }}">Health and Wellness
                                    Pillar</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(21)) }}">How to get here</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(22)) }}">How to move here</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(23)) }}">Agro Tourism Pillar</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(24)) }}">Kalinago Pillar</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(25)) }}">Romance Pillar</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(26)) }}">Aerial Views</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(27)) }}">Waitukubuli Trail</a>
                                <a href="{{ url('/admin/edit_menu/' . base64_encode(28)) }}">Places of Interest</a>
                            </div>
                        </li>

                        <li class="menu-item" onclick="window.location='{{ route('about_us.edit') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/about-side-icon.svg') }}" alt=""> About Us
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('ratings.index') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/about-side-icon.svg') }}" alt=""> All Comments
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('weather.edit_weather') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/weather-side-icon.svg') }}" alt=""> Weather
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('achievements.index') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/achivement-side-icon.svg') }}" alt=""> Achievements
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('push_notifications.index') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/push-side-icon.svg') }}" alt=""> Push Notifications
                        </li>
                    </ul>
                </div>
                <div class="sidebar-main-foot">
                    <ul class="menu-list">
                        {{-- <li class="menu-item">
                            <img src="{{ asset('images/support-side-icon.svg') }}" alt=""> Support
                        </li> --}}
                        <li class="menu-item" onclick="window.location='{{ route('password.change.view') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/setting-side-icon.svg') }}" alt=""> Settings
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('logout') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/setting-side-icon.svg') }}" alt=""> Logout
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-footer">
                <div class="profile-card">
                    <div class="profile-info">
                        <!-- Profile Image -->
                        {{-- <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('images/user_profiles/default-profile-pic.svg') }}"
                            alt="User Image" class="profile-img"> --}}

                        <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('images/profile-pic.svg') }}"
                            alt="User Image" class="profile-img">
                        <div class="profile-text">
                            <!-- User Name and Email -->
                            <div class="profile-name">{{ Auth::user()->name }}</div>
                            <div class="profile-email">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="dropdown-icon">
                        <a href="#"><img src="{{ asset('images/caret-double-vert.svg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main">
            @yield('content')
        </div>
    </div>

    <!-- Custom Scripts -->
    <script src="{{ asset('js/admin.js') }}"></script>

    @yield('custom_js')
</body>

</html>
