<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title', 'App Pegawai')</title>
</head>

<body>
    <div class="container mt-4">
    <header>
        <h1>@yield('page-title', 'App Pegawai')</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/employees.index') }}">Employee</a></li>
                <li><a href="{{ url('/department') }}">Department</a></li>
                <li><a href="{{ url('/attendance') }}">Attendance</a></li>
                <li><a href="{{ url('/report') }}">Report</a></li>
                <li><a href="{{ url('/settings') }}">Settings</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} App Pegawai</p>
    </footer>
</body>
</html>