<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li>
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="{{ route('admin.users') }}">
                    Users
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="{{ route('admin.settings') }}">
                    Settings
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>