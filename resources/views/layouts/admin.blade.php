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
                    <div class="search">
                        <div class="search-container">
                            <span class="search-icon"><img src="{{ asset('images/search-icon.svg') }}"
                                    alt=""></span>
                            <input type="text" placeholder="Search..." class="search-input">
                            <span class="search-shortcut">⌘K</span>
                        </div>
                    </div>
                    <ul class="menu-list ">
                        <li class="menu-item" onclick="window.location='{{ route('dashboard') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/home-line.svg') }}" alt=""> Dashboard
                        </li>
                        <li class="menu-item">
                            <img src="{{ asset('images/hike-icon.svg') }}" alt=""> Hike Details
                        </li>
                        <li class="menu-item">
                            <img src="{{ asset('images/feature-side-icon.svg') }}" alt=""> Featured Locations
                        </li>
                        <li class="menu-item has-submenu">
                            <img src="{{ asset('images/app-side-icon.svg') }}" alt=""> App Menus <span
                                class="submenu-icon"><img src="{{ asset('images/caret-right.svg') }}"
                                    alt=""></span>
                        </li>
                        <li class="menu-item" onclick="window.location='{{ route('about_us.edit') }}';"
                            style="cursor: pointer;">
                            <img src="{{ asset('images/about-side-icon.svg') }}" alt=""> About Us
                        </li>
                        <li class="menu-item">
                            <img src="{{ asset('images/weather-side-icon.svg') }}" alt=""> Weather
                        </li>
                        <li class="menu-item has-submenu">
                            <img src="{{ asset('images/achivement-side-icon.svg') }}" alt=""> Achievements
                            <span class="submenu-icon"><img src="{{ asset('images/caret-right.svg') }}"
                                    alt=""></span>
                        </li>
                        <li class="menu-item">
                            <img src="{{ asset('images/push-side-icon.svg') }}" alt=""> Push Notifications
                        </li>
                    </ul>
                </div>
                <div class="sidebar-main-foot">
                    <ul class="menu-list">
                        <li class="menu-item">
                            <img src="{{ asset('images/support-side-icon.svg') }}" alt=""> Support
                        </li>
                        <li class="menu-item">
                            <img src="{{ asset('images/setting-side-icon.svg') }}" alt=""> Settings
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
