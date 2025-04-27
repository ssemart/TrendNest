<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Dashboard') - TrendNest</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('admin_asset/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/css/light.css') }}">
    @stack('styles')
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
                    <span class="align-middle">TrendNest Admin</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i>
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.profile') }}">
                            <i class="align-middle" data-feather="user"></i>
                            <span class="align-middle">Profile</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.products') }}">
                            <i class="align-middle" data-feather="package"></i>
                            <span class="align-middle">Products</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.categories') }}">
                            <i class="align-middle" data-feather="grid"></i>
                            <span class="align-middle">Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.subcategories.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.subcategories') }}">
                            <i class="align-middle" data-feather="layers"></i>
                            <span class="align-middle">Subcategories</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Management
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.manage.user') }}">
                            <i class="align-middle" data-feather="users"></i>
                            <span class="align-middle">Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.stores.index') }}">
                            <i class="align-middle" data-feather="shopping-bag"></i>
                            <span class="align-middle">Stores</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Orders
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.cart.history') }}">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                            <span class="align-middle">Cart History</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.order.history') }}">
                            <i class="align-middle" data-feather="dollar-sign"></i>
                            <span class="align-middle">Order History</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Settings
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.settings') }}">
                            <i class="align-middle" data-feather="settings"></i>
                            <span class="align-middle">General Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <!-- Top navbar -->
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->profile_picture_url }}" class="avatar img-fluid rounded me-1"
                                    alt="{{ Auth::user()->name }}" />
                                <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="align-middle me-1" data-feather="user"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="align-middle me-1" data-feather="log-out"></i> Log out
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <strong>TrendNest Admin</strong> &copy; {{ date('Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            
            // Initialize Feather icons
            feather.replace();
            
            // Initialize all dropdowns
            try {
                var dropdownElementList = document.querySelectorAll('.dropdown-toggle');
                console.log('Found dropdowns:', dropdownElementList.length);
                
                dropdownElementList.forEach(function(element) {
                    var dropdown = new bootstrap.Dropdown(element);
                    element.addEventListener('click', function(e) {
                        e.stopPropagation();
                        dropdown.toggle();
                    });
                });
            } catch (error) {
                console.error('Error initializing dropdowns:', error);
            }
        });
    </script>
    <script src="{{ asset('admin_asset/js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>