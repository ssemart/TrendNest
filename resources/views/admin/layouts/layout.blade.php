<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Dashboard') - TrendNest</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Core Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    
    <!-- Admin Styles -->
    <link rel="stylesheet" href="{{ asset('admin_asset/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/css/light.css') }}">
    
    <!-- Custom Admin Styles -->
    <style>
        :root {
            --primary-color: #0f3460;
            --secondary-color: #e94560;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
            --light-bg: #f5f5f5;
            --dark-bg: #1a1a1a;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
        }

        /* Modern Sidebar */
        .sidebar {
            background: white;
            border-right: 1px solid var(--border-color);
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
        }

        .sidebar-brand {
            padding: 1.5rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 0;
        }

        .sidebar-header {
            color: var(--primary-color);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 1.5rem 1.5rem 0.5rem;
        }

        .sidebar-item {
            margin: 0.25rem 1rem;
            border-radius: 0.5rem;
        }

        .sidebar-link {
            padding: 0.75rem 1rem;
            color: #666;
            display: flex;
            align-items: center;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover,
        .sidebar-item.active .sidebar-link {
            background: var(--primary-color);
            color: white;
        }

        .sidebar-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        /* Modern Header */
        .navbar {
            background: white;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 0.75rem 1.5rem;
        }

        .navbar-bg {
            background: white;
        }

        /* Search Bar */
        .search-box {
            position: relative;
            max-width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid var(--border-color);
            border-radius: 2rem;
            background: var(--light-bg);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: none;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: darken(var(--primary-color), 10%);
            border-color: darken(var(--primary-color), 10%);
        }

        /* Tables */
        .table {
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }

        .table th {
            border: none;
            background: var(--light-bg);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 1rem;
        }

        .table td {
            border: none;
            background: white;
            vertical-align: middle;
            padding: 1rem;
        }

        .table tr:hover td {
            background: var(--light-bg);
        }

        /* Forms */
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
    
    @stack('styles')
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('frontend/img/core-img/trendnest-logo.png') }}" alt="TrendNest" height="30">
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Dashboard
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Overview</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Catalog
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.products') }}">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Products</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.categories') }}">
                            <i class="fa fa-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.subcategories.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.subcategories') }}">
                            <i class="fa fa-sitemap"></i>
                            <span>Subcategories</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Sales
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.cart.history') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Orders</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.order.history') }}">
                            <i class="fa fa-money"></i>
                            <span>Transactions</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Users
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.manage.user') }}">
                            <i class="fa fa-users"></i>
                            <span>Customers</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.stores.index') }}">
                            <i class="fa fa-store"></i>
                            <span>Stores</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <!-- Top navbar -->
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="search-box d-none d-md-inline-block">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="indicator"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="notificationsDropdown">
                            <div class="dropdown-menu-header">
                                Notifications
                            </div>
                            <div class="list-group">
                                <!-- Notifications will be dynamically loaded here -->
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('admin_asset/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded-circle me-1" alt="Admin">
                            <span class="text-dark">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                <i class="fa fa-user"></i> Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fa fa-sign-out"></i> Sign out
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Main content -->
            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="{{ route('home') }}" class="text-muted"><strong>TrendNest</strong></a> &copy; {{ date('Y') }}
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/app.js') }}"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sidebar Toggle
            document.querySelector(".sidebar-toggle").addEventListener("click", function() {
                document.querySelector(".sidebar").classList.toggle("collapsed");
                document.querySelector(".main").classList.toggle("expanded");
            });

            // Dropdown initialization
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            });

            // Theme initialization
            var theme = localStorage.getItem('theme') || 'light';
            document.body.setAttribute('data-theme', theme);
        });
    </script>

    @stack('scripts')
</body>

</html>